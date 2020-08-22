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
        SET_PRODUCT: (state, product) => {
            state.product = product
        },
        SET_CARD_INFO: (state, card) => {
            state.cardInfo = card
        },
        SET_CUSTOMER_INFO: (state, customer) => {
            state.customerInfo = customer
        },
        SET_SHIPPING_FEE: (state, value) => {
            state.shippingFee = value
        },
        // other mutations
    },
    actions: {
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
        setShippingFee: ({commit, state}, shippingFee) => {
            commit('SET_SHIPPING_FEE', shippingFee)
            return state.shippingFee
        }


        // other actions
    }

}