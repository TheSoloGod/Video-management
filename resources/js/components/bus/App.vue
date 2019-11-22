<template>
    <div>
        <div>
            <Foo></Foo>
        </div>
        <hr>
        <div>
            <Bar></Bar>
        </div>
    </div>
</template>

<script>
    import Foo from "./Foo";
    import Bar from "./Bar";
    export default {
        name: "App",
        components: {
            Foo,
            Bar,
        }
    }
</script>

<style scoped>

</style>
