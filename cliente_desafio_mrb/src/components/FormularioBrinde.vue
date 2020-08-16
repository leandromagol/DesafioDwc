<template>
  <div class="container-fluid m-0 p-0">
    <div id="home-page" class="full-heigth bg-danger p-4">
      <div class="container p-3">
        <div class="row pb-5">
          <div class="col-12 d-flex justify-content-center">
            <div class="col-lg-6">
              <div class="text-center mb-3">
                <h4 class="text-white">
                  Preencha seus dados para que possamos enivar seu brinde
                </h4>
              </div>
              <div class="border p-3 p-md-5 bg-white rounded shadow">
                
                <form @submit.prevent="enviar_pedido_binde()">
                    <p v-if="errors.length > 0">
                      <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
                      <div  v-for="error in errors" class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </p>
                  <div class="form-group ">
                    <label class="d-flex justify-content-start" for="email"
                      >Email</label
                    >
                    <input
                      v-model="email"
                      id="email"
                      placeholder="email@email.com"
                      class="form-control"
                      type="email"
                      name="email"
                      value
                      readonly  
                    />
                  </div>
                  <div class="form-group">
                    <label class="d-flex justify-content-start" for="nome"
                      >nome</label
                    >
                    <input
                      v-model="nome"
                      id="nome"
                      class="form-control"
                      type="text"
                      name="email"
                      value
                      required
                    />
                  </div>
                  <div class="row">
                    <div class="form-group col-4">
                      <label class="d-flex justify-content-start" for="cep"
                        >CEP</label
                      >

                      <the-mask
                        type="text"
                        v-model="cep"
                        id="inputCep"
                        class="form-control"
                        name="cep"
                        value
                        mask="#####-###"
                        @keyup.native="buscar"
                        required
                      />
                    </div>
                    <div class="form-group col-2">
                      <label class="d-flex justify-content-start" for="uf"
                        >UF</label
                      >
                      <the-mask
                        type="text"
                        v-model="uf"
                        id="uf"
                        class="form-control"
                        name="uf"
                        value
                        mask="AA"
                        required
                      />
                    </div>
                    <div class="form-group col-6">
                      <label class="d-flex justify-content-start" for="cidade"
                        >Cidade</label
                      >
                      <input
                        v-model="cidade"
                        id="cidade"
                        class="form-control"
                        type="text"
                        name="cidade"
                        value
                        required
                      />
                    </div>
                    <div class="form-group col-2">
                      <label class="d-flex justify-content-start" for="cidade"
                        >Numero</label
                      >
                      <input
                        v-model="numero"
                        id="numero"
                        class="form-control"
                        type="text"
                        name="numero"
                        value
                        required
                      />
                    </div>
                    <div class="form-group col-10">
                      <label
                        class="d-flex justify-content-start"
                        for="logradouro"
                        >Logradouro</label
                      >
                      <input
                        v-model="logradouro"
                        id="logradouro"
                        class="form-control"
                        type="text"
                        name="logradouro"
                        value
                        required
                      />
                    </div>
                    <div class="form-group col-12">
                      <label class="d-flex justify-content-start" for="telefone"
                        >Telefone</label
                      >

                      <the-mask
                        type="text"
                        v-model="telefone"
                        id="telefone"
                        class="form-control"
                        name="telefone"
                        value
                        :mask="['(##)####-####', '(##)#####-####']"
                        required
                        
                      />
                    </div>
                  </div>

                  <button type="submit" class="btn btn-success mt-3">
                    Enviar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="footer" class="bg-danger p-4"></div>
  </div>
</template>

<script>
import axios from "axios";
const config = {
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Access-Control-Allow-Origin': '*',

  }
}

export default {
  data() {
    return {
      title: "Formulario de envio",
      email: "",
      nome: "",
      uf: "",
      cep: "",
      cidade: "",
      numero: "",
      logradouro: "",
      telefone: "",
      message: "",
      errors: [],
    };
  },
  mounted: function() {
    this.verifica_token();
  },
  methods: {
    enviar_pedido_binde: function() {
        if (this.validade_from() == true) {
        axios.post(this.apiurl+'cliente',{email:this.email,nome:this.nome,uf:this.uf,cep:this.cep,cidade:this.cidade,logradouro:this.logradouro,telefone:this.telefone,numero:this.numero})
      .then(res=>{
        if (res.status == 201 ) {
           this.$swal.fire({
            icon: "success",
            title: "Recebemos sua solicitação aguarde logo enviaremos seu binde",
            showConfirmButton: false,
            allowOutsideClick: false
          });
        }
      }).catch(err=>{

      })
      }
      
    },
    buscar: function() {
       
      if (/^[0-9]{8}$/.test(this.cep)) {
        this.$swal.fire({
            icon: "success",
            title: "Estamos buscando seu endereço",
            showConfirmButton: false
          });
        axios
          .get("https://viacep.com.br/ws/" + this.cep + "/json/")
          .then(res => {
            this.$swal.close()
            if (res.status == 200 && !res.data.erro) {
              this.cidade = res.data.localidade;
              this.uf = res.data.uf;
              this.logradouro = res.data.bairro + " " + res.data.logradouro;
            }
            if(res.data.erro){
             this.$swal.fire({
            icon: "error",
            title: "CEP invalido",
            showConfirmButton: true
          });
          this.errors = [];
           this.errors.push('Cep invalido');
            }
          })
          .catch(err => {
            this.$swal.fire({
            icon: "error",
            title: "erro ao busca tente novamente",
            showConfirmButton: true
          });
          });
      }
    },
    validade_from:function(){
          this.errors = [];
          var telefoneREG = new RegExp('^((1[1-9])|([2-9][0-9]))((3[0-9]{3}[0-9]{4})|(9[0-9]{3}[0-9]{5}))$');
         

      if (!this.email) {
          this.errors.push('O email é obrigatório.');
         }
         if (!this.nome) {
          this.errors.push('O nome é obrigatório.');
         }
         if (!this.uf) {
          this.errors.push('O uf é obrigatório.');
         }
         if (!this.cep) {
          this.errors.push('O cep é obrigatório.');
         }
         if (!this.cidade) {
          this.errors.push('A cidade é obrigatório.');
         }
         if (!this.numero) {
          this.errors.push('O numero é obrigatório.');
         }
         if (!this.logradouro) {
          this.errors.push('O logradouro é obrigatório.');
         }
        if (!this.telefone) {
          this.errors.push('O telefone é obrigatório.');
         }
         if (telefoneREG.test(this.telefone)) {
         }else{
          this.errors.push('O telefone é invalido.');
         }
         if(this.errors.length != 0){
            return false;
         }else{
            return true;
         }
    },
    verifica_token:function(){
      axios.get(this.apiurl+'pedidosbrinde/'+this.$route.params.token)
      .then(response=>{
        this.email = response.data.email;
        if(response.data.token_inativo != 0){
           this.$swal.fire({
            icon: "info",
            title: "Seu pedido ja foi efetuado estamos preparando o envio",
            showConfirmButton: false,
            allowOutsideClick: false

          });
        }
      }).catch(error=>{

      })
    }
  },
  beforeMount(){
    
 }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
