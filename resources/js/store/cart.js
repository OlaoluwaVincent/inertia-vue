import { defineStore } from "pinia";
import { ref } from "vue";

export const useCartStore = defineStore(
    "cart",
    () => {
        const cart = ref([]);

        function addToCart(value) {
            if (checkExisting(value.id)) return;
            cart.value.push(value);
        }

        function checkExisting(id) {
            if (cart.value !== undefined && cart.value.length > 0) {
                const index = cart.value.findIndex((item) => item.id === id);
                return index >= 0;
            }

            return false;
        }

        return {
            cart,
            addToCart,
        };
    },
    { persist: true }
);
