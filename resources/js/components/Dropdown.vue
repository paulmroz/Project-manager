<template>
    <div class="dropdown">
        <slot name="trigger"></slot>


        <div class="dropdown-menu">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {isOpen: false}
        }
    }
</script>

<style scoped>

</style>
