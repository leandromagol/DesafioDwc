<template>
  <div class="container-fluid m-0 p-0">
    <div id="home-page" class="full-heigth bg-danger p-4">
      <div class="container p-3">
        <div class="row pb-5">
          <div class="col-12 d-flex justify-content-center">
            <div class="col-lg-6">
              <div class="text-center mb-3">
                <h4 class="text-white">
                  Peididos de etiqueta
                </h4>
              </div>
              <div class="border p-3 p-md-5 bg-white rounded shadow">
                <h3>Para receber seu brinde por favor</h3>
                <form @submit.prevent="enviar_pedido_binde()">
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
                        :mask="['(##) ####-####', '(##) #####-####']"
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
      message: ""
    };
  },
  mounted: function() {},
  methods: {
    enviar_pedido_binde: function() {
      axios.put(this.apiurl+'pedidosbrinde/1',{email:this.email,nome:this.nome,uf:this.uf,cep:this.cep,cidade:this.cidade,logradouro:this.logradouro,telefone:this.telefone,numero:this.numero})
      .then(res=>{
        console.log(res);
        if (res.status == 200 ) {
           this.$swal.fire({
            icon: "success",
            title: "Recebemos sua solicitação aguarde logo enviaremos seu binde",
            showConfirmButton: false
          });
        }
      }).catch(err=>{

      })
    },
    buscar: function() {
      
      if (/^[0-9]{8}$/.test(this.cep)) {
        axios
          .get("https://viacep.com.br/ws/" + this.cep + "/json/")
          .then(res => {
            if (res.status == 200) {
              this.cidade = res.data.localidade;
              this.uf = res.data.uf;
              this.logradouro = res.data.bairro + " " + res.data.logradouro;
            }
          })
          .catch(err => {
            this.$swal.fire({
            icon: "erro",
            title: err,
            showConfirmButton: false
          });
          });
      }
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
