<template>
    <div class="search">
        <form class='form-group search__input-container d-flex flex-column align-items-center justify-content-start'>
            <label class='search__label'>{{translate('searchTitle')}}</label>
            <div class='search__input-box'>
                <i class="icon-search-1 search__icon"></i>
                <input type='search' :placeholder="translate('searchPlaceholder')" name='search' class='search__input'/>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'Search',
}
</script>