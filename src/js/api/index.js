const getTrainings = () => {
    return axios.get(`/api/v2/trainings`)
};

const getTraining = (id) => {
    return axios.get(`/api/v2/trainings/getByPage/${id}`)
};

const getPartners = () => {
    return axios.get(`/api/v1/partners`)
},

export {
    getTrainings,
    getTraining,
    getPartners
};