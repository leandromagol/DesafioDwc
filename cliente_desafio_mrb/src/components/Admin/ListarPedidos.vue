<template>
  <div class="container-fluid m-0 p-0">
    <div id="home-page" class="full-heigth bg-danger p-4">
      <div class="container p-3">
        <div class="row pb-5">
          <div class="col-12 d-flex justify-content-center">
            <div class="">
              <div class="text-center mb-3">
                <h4 class="text-white">
                  Peididos de etiqueta
                </h4>
              </div>
              <div class="border p-3 p-md-5 bg-white rounded shadow">
               <vue-good-table id="my-table"
  :columns="columns"
  :rows="rows"
  @on-page-change="caregar_registros()"
  :pagination-options="{
    enabled: true,
    mode: 'pages',
    nextLabel: 'Proximo',
    prevLabel: 'Anterior',
    rowsPerPageLabel: 'Registros por pagina',
    pageLabel: 'pagina',
    ofLabel: 'de',
  }"
   :search-options="{
    enabled: true,
     placeholder: 'Buscar pedidos de etiqueta',
  }"
  :select-options="{ 
    enabled: true,
     selectionText: 'Registros selecionados',
     clearSelectionText: 'limpar',

  }"
  @on-selected-rows-change="selectionChanged"

  >
   <div slot="selected-row-actions">
    <button v-on:click="mostrar_selecionados" class="btn btn-warning">Enviar</button>
  </div>
</vue-good-table>
               
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
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';
export default {
  name: "app",

 components: {
  VueGoodTable,
},

  data() {
    return {
      rowSelection: [],
       columns: [
        {
          label: 'Nome',
          field: 'nome',
        },
        {
          label: 'Email',
          field: 'email',
        },
        {
          label: 'Cidade',
          field: 'cidade',
        },
        {
          label:'UF',
          field:'uf'
        },
        {
          label:'Cep',
          field:'cep'
        },
        {
          label:"Numero",
          field:'numero'
        },
        {
          label:'Logradrouro',
          field:'logradouro'
        },
        {
          label:'Telefone',
          field:'telefone'
        },
        {
          label:'Enviado',
          field:'enviado',
          formatFn:this.pedido_enviado
        }
      ],
      rows: [
      ],
    };
  },


  mounted() {
    this.caregar_registros();

     window.setInterval(() => {
      this.caregar_registros()
  }, 300000)
  },

  methods: {
    caregar_registros: function(){
      axios.get(this.apiurl+'cliente').then(response => {
      this.rows = response.data;
      console.log(response.data);
    });
    },
    mostrar_selecionados:function(){
      console.log(this.rowSelection);
      this.rowSelection.map(pedido=>{
        console.log(pedido.id);
        axios.put(this.apiurl+'cliente/'+pedido.id,{enviado:1}).then(response=>{
          
        }).catch(error=>{
          console.log(error);
        })
      })
      this.caregar_registros();
    },
    selectionChanged(params) {
     this.rowSelection = params.selectedRows;
    },
    pedido_enviado:function(enviado){
      if(enviado == 0){
        return "Pendente";
      }else{
        return "Enviado";
      }
    } 
  }
};
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
