<template>
    <transition name="fade">
        <div class="loading d-flex justify-content-center align-items-center">
            <div class="loading__wrapper">
                <span class="triangle1"></span>
                <span class="triangle2"></span>
                <span class="triangle3"></span>
                <span class="triangle4"></span>
            </div>
        </div>
    </transition>
</template>

<script>

export default {
    name: 'SplashPage'
}
</script>