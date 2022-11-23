import { defineStore } from 'pinia'
import api from "@/api/securityApi.js"

interface State {
  securities: Security[]
  securityRoles: Roles[]
  securityModalOpen: Boolean
  errorMessage: string | null | undefined
  addFormValue: FormValue
}

interface Security {
  id: string
  lastName: string
  middleName: string
  name: string
  role: Roles
  roleSecurityId: number
}

interface Roles {
  id: string 
  title: string
  deletion: Number
}

interface FormValue {
  name: string
  lastName: string
  middleName: string
  roleSecurityId: number
}

export const useSecurityStore = defineStore('user', {
  state: (): State => {
    return {
      securities: [],
      securityRoles: [],
    
      securityModalOpen: false,
      addFormValue: {
        name: '',
        lastName: '',
        middleName: '',
        roleSecurityId: 3
      },
    
      errorMessage: null
      // // for initially empty lists
      // userList: [] as UserInfo[], 
      // // for data that is not yet loaded
      // user: null as UserInfo | null,
      // count: 0 as number
    }
  },

  actions: {
    async getSecurities(){
      const data = await api.getSecurities()
      this.securities = data
      console.log('getSecurities', data)
    }
  },
})