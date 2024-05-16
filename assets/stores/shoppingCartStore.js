import {defineStore } from 'pinia'

const SHOPPING_CART_PERSISTENCE_URL = '../shoppingCart';

export const useShoppingCartStore = defineStore('shoppingCartContent',{
    state:()=>({
        products:[],
    }),
    getters: {
        getShoppingCartProductList: (state) => {
            return state.products;
        },
        getTotalCost: (state) => {
            let totalCost = 0;
            if(state.products.length > 0){
                state.products.forEach((product)=>{
                    totalCost += product['price']*product['amount'];
                });
            }
            return totalCost;
        }
    },
    actions:{
        addProductToShoppingCart(addedProduct){
            if('productid' in addedProduct && 'amount' in addedProduct && 'price' in addedProduct){
               console.log(" ####### Added product: ", addedProduct, " to shoppingCartStore.")

                this.products.push(addedProduct);
                console.log(this.products);
            }
        },
        modifyShoppingCartPersistence(){
            const axios = require("axios");

            axios
                .put(
                    SHOPPING_CART_PERSISTENCE_URL,
                    this.products,
                    {headers: {"Content-Type": "application/json"}}
                )
                .then(r => console.log(r.status))
                .catch(e => console.log(e));

        },
        $reset(){
            this.products = []
        }
    }
});