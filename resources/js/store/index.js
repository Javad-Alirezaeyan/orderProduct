export default {

    state: {
        message: 'hello',
        product: {},
        shippingFee: 0,
        customerInfo: {
            firstName: '',
            lastName: '',
            email: '',
            address: ''
        },
        cardInfo: {
            name: '',
            cardNumber: '',
            cvv: '',
            year: '',
            month: ''
        }
    },
    getters: {
        message: (state) => {
            return state.message
        },

        product: (state) => {
            return state.product
        }
        // other getters
    },
    mutations: {
        SET_MESSAGE: (state, newValue) => {
            state.message = newValue
        },
        SET_PRODUCT: (state, product) => {
            state.product = product
        },
        SET_CARD_INFO: (state, card) => {
            state.cardInfo = card
        },
        SET_CUSTOMER_INFO: (state, card) => {
            state.cardInfo = card
        },
        SET_SHIPPING_FEE: (state, value) => {
            state.shippingFee = value
        },
        // other mutations
    },
    actions: {
        setMessage: ({commit, state}, newValue) => {
            commit('SET_MESSAGE', newValue)
            return state.message
        },
        setProduct: ({commit, state}, product) => {
            commit('SET_PRODUCT', product)
            return state.product
        },
        setCardInfo: ({commit, state}, card) => {
            commit('SET_CARD_INFO', card)
            return state.cardInfo
        },
        setCustomerInfo: ({commit, state}, customer) => {
            commit('SET_CUSTOMER_INFO', customer)
            return state.customerInfo
        },
        setShippingFee: ({commit, state}, customer) => {
            commit('SET_SHIPPING_FEE', customer)
            return state.customerInfo
        }


        // other actions
    }

}