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

        function removeFromCart(id) {
            cart.value = cart.value.filter((item) => item.id !== id);
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
            removeFromCart,
            checkExisting,
        };
    },
    { persist: true }
);
