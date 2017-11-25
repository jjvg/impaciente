<template>
        <div>
           <p class="text-center" v-if="loading">
               Cargando...
           </p>

           <p class="text-center" v-if="!loading">
                <button class="btn btn-warning"  v-if="status == 0"  @click="agregar_amigo">Agregar Amigo</button>
                <button class="btn btn-warning"  v-if="status =='pendiente' " @click="aceptar_amigo">Aceptar Amigo</button>
                <span class="text-success" v-if="status == 'esperando'">Esperando Respuesta</span>
                <span class="text-success" v-if="status == 'amigos'">Amigos</span>
           </p>
          
        </div>
   
</template>

<script>
    export default {
        mounted() {
          
            this.$http.get('/check_status_amistades/'+this.perfil_user_id)
                .then( (resp) =>{
                    console.log(resp)
                    this.status = resp.body.status
                    this.loading = false
                    })
             
        },
        props: ['perfil_user_id'],
        data()
        {
            return {
                status: '',
                loading: true
            }
        },
        methods: {

            agregar_amigo(){
                
                this.loading == true
                this.$http.get('/agregar_amigo/' + this.perfil_user_id)
                    .then((resp) =>{
                        if(resp.body == 1)
                        
                            this.status == 'esperando'
                  new Noty({

                            type: 'success',
                            layout: 'bottonleft',
                            text: 'Solicitud de amistad enviada.',
                            timeout: 3000
                        }).show();
                            this.loading == false
                                    
                     })
            },

            aceptar_amigo(){

                  this.loading == true
                this.$http.get('/aceptar_amigo/' + this.perfil_user_id)
                    .then((resp) =>{
                        if(resp.body == 1)
                        
                            this.status == 'amigos'

                       new Noty({

                            type: 'success',
                            layout: 'bottonleft',
                            text: 'tu tienes un nuevo amigo ahora.',
                            timeout: 3000
                        }).show();
                            this.loading == false
                                    
                     })
            }
        }


    }
</script>
