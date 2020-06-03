<template>
    <div class="input-group">
        <div class="input-group-prepend">
            <b-link href="#" class="input-group-text iconlogin" @click="showPass">
            <span class=""><i :class="{'fas':true,
								'fa-eye-slash':lock,
								'fa-eye':!lock}"/></span>
            </b-link>
        </div>
        <input id="password" :type="eyepass" :name="namepass" required :placeholder="campopass"
        class="form-control" @blur="inputvalue" ref="inputpass">
        <!--class="form-control" :v-model="modelprop">-->
               <!--:class="newclass" >-->
    </div>
</template>

<script>
    import EventBus from "../event-bus";

    export default {
        props: {
            campopass: {},
            namepass: '',
            //newclass: ''  MIRAR REGISTRO,

            modelprop: '',
        },
        data(){
            return {
                lock    : true,
                eyepass: 'password',
            } ;
        },
        computed: {
            getmodel(){
                return this.modelprop;
            }
        },
        mounted() {
            console.log('eye pass login component mounted');
        },
        methods:{
            showPass: function()
            {
                this.lock     = !this.lock ;
                this.eyepass = (this.lock)?'password':'text' ;
            },
            inputvalue(){
                EventBus.$emit('inputval', [this.$refs.inputpass.value, this.getmodel]);
            }
        },

    }
</script>

<style>

</style>
