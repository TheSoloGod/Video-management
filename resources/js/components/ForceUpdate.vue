<template>
    <div>
        <div>
            Name: {{ person.name}}
        </div>
        <div>
            Nick name: {{ person.nickname}}
        </div>
        <div>
            <button @click="changeName">Change Name</button>
        </div>
        <div>
            <button @click="changeNickname">Change Nickname</button>
        </div>
        <div>
            <button @click="changeNicknameProperly">Change Nick name properly</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ForceUpdate",
        data() {
            return {
                person: {
                    name: 'Edison',
                }
            }
        },
        methods: {
            changeName() {
                this.person.name = 'Arantes';
            },
            changeNickname() {
                this.person.nickname = Math.random().toString(36).substring(7);
                this.$forceUpdate();
            },
            changeNicknameProperly() {
                Vue.set(this.person, 'nickname', 'Louis');
            }
        }
    }
</script>

<style scoped>

</style>
