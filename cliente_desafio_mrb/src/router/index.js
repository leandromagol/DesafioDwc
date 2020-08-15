import Vue from 'vue'
import Router from 'vue-router'
import LeadHome from '@/components/LeadHome'
import Formulario from '@/components/FormularioBrinde';
import Listagem from '@/components/Admin/ListarPedidos'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'LeadHome',
      component: LeadHome
    },
    {
      path: '/form',
      name: 'Formulario de Envio',
      component: Formulario
    },
    {
      path:'/admin/listar',
      name :'Listagem de editiquetas',
      component:Listagem
    }
  ]
})
