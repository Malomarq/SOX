<template>
    <div class="input-group">
        <div class="input-group-prepend">
            <b-link href="#" class="input-group-text iconlogin" @click="showPass">
            <span class=""><i :class="{'fas':true,
								'fa-eye-slash':lock,
								'fa-eye':!lock}"/></span>
            </b-link>
        </div>
        <input :type="eyepass" :name="namepass" :placeholder="campopass"
               :class="customclass" @blur="inputvalue" ref="inputpass">
    </div>
</template>

<script>
    import EventBus from "../event-bus";

    export default {
        props: {
            campopass: {},
            namepass: '',
            customclass: '',
            modelprop: '',
        },
        data() {
            return {
                lock: true,
                eyepass: 'password',
            };
        },
        computed: {
            getmodel() {
                return this.modelprop;
            },
        },
        mounted() {
        },

        methods: {

            /**
             * Shows password if clicked
             */
            showPass: function () {
                this.lock = !this.lock;
                this.eyepass = (this.lock) ? 'password' : 'text';
            },

            /**
             * Emits "inputval" event with the password value
             */
            inputvalue() {
                EventBus.$emit('inputval', [this.$refs.inputpass.value, this.getmodel]);
            }
        },

    }
</script>

<style>

</style>
