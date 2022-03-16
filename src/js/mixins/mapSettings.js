import { style } from './mapStyle.js';

const mapSettings = {
    data() {
        return {
            typeOfPartner: '',
            partnerTypes: [
                {
                    id: 0,
                    label: this.translate('training1'),
                    name: 'Trustee',
                    description: this.translate('training1Descr'),
                    type: 'fiduciary',
                },
                {
                    id: 1,
                    label: this.translate('training2'),
                    name: 'Partner',
                    description: this.translate('training2Descr'),
                    type: 'partner'
                },
                {
                    id: 2,
                    label: this.translate('training3'),
                    name: 'Winbiz Specialist',
                    description: this.translate('training3Descr'),
                    type: 'specialist'
                }
            ],
            map: null,
            mapCenter: { lat: 46.565312, lng: 7.265078 },
            currentMapZoom: 8,
            gmapMarkers: [],
            branches: [],
            partners: [],
            fiduciaries: [],
            specialists: [],
            infoWindow: null,
        }
    },
    mounted() {
        this.initMap();
        this.initAutocomplete();

        if (this.allPartners.length) {
            this.setPartners();
        } else {
            this.getPartners();
        }
    },
    watch: {
        'typeOfPartner': function (value) {
            this.setMarkers();
        },
    },
    methods: {
        getPartners () {
            axios.get(`/${this.$route.params.locale}/api/v2/partners`).then(response => {
                this.$store.commit('setPartners', response.data)
                this.setPartners()
            }, err => {
                alert('error fetching partners')
            })
        },
        setPartners () {
            this.branches = this.allPartners.filter(p => p.type === 'succursale');
            this.partners = this.allPartners.filter(p => p.type === 'partner' || p.type === 'partner_premium');
            this.fiduciaries = this.allPartners.filter(p => p.type === 'fiduciary');
            this.specialists = this.allPartners.filter(p => p.type === 'specialist');
            this.setMarkers();
        },
        initMap() {
            this.map = new google.maps.Map(document.getElementById('map'), {
                center: this.mapCenter,
                zoom: 8,
                maxZoom: 20,
                minZoom: 3,
                streetViewControl: false,
                mapTypeControl: false,
                rotateControl: true,
                zoomControl: true,
                fullScreenControl: false,
                styles: style
            });


            this.map.addListener('zoom_changed', () => {
                this.currentMapZoom = this.map.zoom
            });
        },
        setMarkers() {
            this.removeExistingMarkers()
            let gmapMarkers = [];
            for (let partner of this.filteredMarkers) {
                const marker = new google.maps.Marker({
                    position: { lat: JSON.parse(partner.lat), lng: JSON.parse(partner.long) },
                    map: this.map,
                    icon: partner.icon,
                    optimized: true,
                });

                const contentString =
                    `<div id="content" class="content">
                        <div id="siteNotice">
                            <p id="firstHeading" class="firstHeading">${partner.company_name}</p>
                            <div id="bodyContent" class="bodyContent">
                                <p id="address" class="address">${partner.street_address}</p>
                                <p class="city">${partner.city}, ${partner.postal_code}</p>
                                <a href="tel:${partner.phone_number}" class="phone">${partner.phone_number}</p>
                                <a href="mailto:${partner.email}" id="email" class="email">${partner.email}</p>
                                <a href="//${partner.website}" target="_blank" class="website">${partner.website}</p>
                            </div>
                        </div>
                    </div>`;

                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 400,
                });

                // open info window on marker click
                marker.addListener('click', () => {
                    infowindow.open(this.map, marker);
                    if (this.currentMapZoom < 12) {
                        this.map.setZoom(12);
                    }
                    this.map.setCenter(marker.getPosition());
                });
                    
                // close infowindow when map is clicked
                this.map.addListener('click', () => {
                    infowindow.close(this.map, marker);
                });
                
                gmapMarkers.push(marker)
            }

            this.gmapMarkers = gmapMarkers
        },
        initAutocomplete () {
            const input = document.getElementById("autocomplete");
            const options = {
                componentRestrictions: { country: "ch" },
                fields: ["geometry", 'name', 'address_components'],
                strictBounds: false
            };
            const autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete?.addListener("place_changed", () => {
                const place = autocomplete?.getPlace();
                const partner = this.searchPartner(place);

                if (partner === null) {
                    if (!place.geometry) {
                        this.map.setCenter(new google.maps.LatLng(this.mapCenter.lat, this.mapCenter.lng));
                        this.map.setZoom(8);
                        return;
                    }

                    if (place.geometry.viewport) {
                        this.map.fitBounds(place.geometry.viewport);
                    } else {
                        this.map.setCenter(place.geometry.location);
                        this.map.setZoom(17);
                    }
                } else {
                    this.map.setCenter(new google.maps.LatLng(partner.lat, partner.lng));
                    this.map.setZoom(17);

                }
            });
        },
        searchPartner (place) {
            let value = null;
            // ignore name empty
            // missing data
            if (place.name.length > 2) {
                for (let i = 0; i < this.filteredMarkers.length; i++) {
                    const localCompanyName = this.filteredMarkers[i].company_name.trim().toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                    const mapCompanyName = place.name.trim().toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                    if (localCompanyName.startsWith(mapCompanyName) || mapCompanyName.includes(localCompanyName)) {
                        google.maps.event.trigger(this.gmapMarkers[i], 'click')
                        return value = this.filteredMarkers[i];
                    }
                }
            }
            return value;
        },
        removeExistingMarkers () {
            for (let marker of this.gmapMarkers) {
                marker.setMap(null)
            }
        }
    },
    computed: {
        allPartners () {
            return this.$store.state.partners
        },
        allMarkers () {
            return {
                'wb-branches': this.branches,
                'partner': this.partners,
                'fiduciary': this.fiduciaries,
                'specialist': this.specialists
            }   
        },
        filteredMarkers() {
            if (this.typeOfPartner) {
                return this.allMarkers['wb-branches'].concat(this.allMarkers[this.typeOfPartner])
            };

            return this.allMarkers['wb-branches'];
        },
    },
};

export default mapSettings;