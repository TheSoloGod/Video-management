<template>
    <div class="form-input-binding">
        <div class="text">
            {{ message }}
        </div>
        <div class="input-form">
            <input type="text" :placeholder="placeholder" :value="value" name="">
        </div>
    </div>
</template>

<script>
    export default {
        name: "FormInputBinding",
        data() {
            return {
                message: '',
                placeholder: 'This is placeholder',
                value: 'This is value',
            }
        }
    }
</script>

<style scoped>

</style>
