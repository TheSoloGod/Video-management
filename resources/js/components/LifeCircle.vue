<template>
    <div id="my-text">

    </div>
</template>

<script>
    export default {
        name: "LifeCircle",
        data() {
            return {
                counter: 0
            }
        },
        update() {
            console.log(+this.$refs['dom-element'].textContent === this.counter)
        },
        created() {
            setInterval(() => {
                this.counter++
            }, 1000)
        }
    }
</script>

<style scoped>

</style>
