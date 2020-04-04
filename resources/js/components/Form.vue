<template>
    <div class="input-group mb-3">
      
      	<!-- INPUTAN INI AKAN KETRIGGER JIKA TOMBOL ENTER DITEKAN -->
        <input type="text" name="message" class="form-control" placeholder="Kirim Pesan..." v-model="message" @keyup.enter="submit">
        <div class="input-group-append">
          
          	<!-- ATAU JIKA TOMBOL SEND DI KLIK -->
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="submit">
                Send
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                message: ''
            }
        },

        methods: {
            submit() {
                this.$emit('sent', {
                    user: this.user,
                    message: this.message
                });

                
                this.message = ''
            }
        }    
    }
</script>