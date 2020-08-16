import VuetableFieldHandle from 'vuetable-2/src/components/VuetableFieldHandle.vue'

export default [
  {
    name: VuetableFieldHandle
  },
  {
    name: 'nome',
    title: '<span class="orange glyphicon glyphicon-user"></span>Nome',
    sortField: 'nome'
  },
  {
    name: 'email',
    sortField: 'email'
  },
  {
    name:'cidade',
    sortField:'cidade'
  },
  {
    name:'uf',
    sortField:'uf'
  },
  {
    name:'cep',
    sortField:'cep'
  },
  {
    name:'numero',
    sortField:'numero'
  },
  {
    name:'logradouro',
    sortField:'logradrouro'
  },
  {
    name:'telefone',
    sortField:'telefone'
  }
]