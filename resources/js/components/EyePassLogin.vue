<template>
    <div class="input-group">
        <div class="input-group-prepend">
            <b-link href="#" class="input-group-text iconlogin" @click="showPass">
            <span class=""><i :class="{'fas':true,
								'fa-eye-slash':lock,
								'fa-eye':!lock}"/></span>
            </b-link>
        </div>
        <input id="password" :type="eyepass" name="password" required :placeholder="campopass" class="form-control">
               <!--:class="newclass" >-->
    </div>
</template>

<script>
    export default {
        props: {
            campopass: {},
            //newclass: ''  MIRAR REGISTRO,
        },

        methods:{
            showPass: function()
            {
                this.lock     = !this.lock ;
                this.eyepass = (this.lock)?'password':'text' ;
            },
        },
        data(){
            return {
                lock    : true,
                eyepass: 'password',
            } ;
        },
        mounted() {
            console.log('eye pass login component mounted');
        }
    }
</script>

<style>

</style>
