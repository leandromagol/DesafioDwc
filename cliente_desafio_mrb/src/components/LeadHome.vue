<template>
  <div class="container-fluid m-0 p-0">
    <div id="home-page" class="full-heigth bg-danger p-4">
      <div class="container p-3">
        <div class="row pb-5">
          <div class="col-lg-6">
            <!-- <img if="cup-img"
              src="../assets/kisspng-cupcake-confectionery-chocolate-cake-decoratie-5beb917019d153.8655210515421648481058.jpg"
            alt="">-->
          </div>
          <div class="col-lg-6">
            <div class="text-center mb-3">
              <h1 class="display-3 text-white">{{ title }}</h1>
              <h3 class="text-white">Obrigado por comprar nosso produto</h3>
            </div>
            <div class="border p-3 p-md-5 bg-white rounded shadow">
              <h3>Para receber seu brinde por favor</h3>
              <form @submit.prevent="enviar_pedido_binde(email)">
                <div class="form-group">
                  <label for="email">Insira seu email a baixo</label>
                  <input
                    v-model="email"
                    id="email"
                    placeholder="email@email.com"
                    class="form-control"
                    type="email"
                    name="email"
                    value
                    v-on:keyup="validar_email"
                  />
                  <button type="submit" class="btn btn-success mt-3">
                    Garanta Ja!
                  </button>
                </div>
              </form>
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

export default {
  data() {
    return {
      title: "MBR- Mulheres bem resolvidas",
      email: "",
      message: ""
    };
  },
  methods: {
    enviar_pedido_binde: function(email) {
      axios
        .post(this.apiurl+"pedidosbrinde", { email: email })
        .then(res => {
          if (res.status == 200) {
            this.$swal.fire({
              icon: "success",
              title: "Email enviado com sucesso ",
              text: res.data,
              showConfirmButton: false
            });
          }
        })
        .catch(err => {
          console.log(err);
          this.$swal.fire({
            icon: "erro",
            title: err,
            showConfirmButton: false
          });
        });
    },
    validar_email:function(){
      
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
