<template>
    <div class="event-handling">
        <div>Current Number: {{ counter}}</div>
        <button @click="increaseCounter(50)">Click</button>
    </div>
</template>

<script>
    export default {
        name: "EventHandling",
        data() {
            return {
                counter: 0,
            }
        },
        methods: {
            increaseCounter(number) {
                this.counter += number;
            }
        }
    }
</script>

<style scoped>

</style>
