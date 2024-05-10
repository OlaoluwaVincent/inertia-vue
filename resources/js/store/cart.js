import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useCartStore = defineStore(
    "cart",
    () => {
        const cart = ref([]);
        const cartLength = computed(() => cart.value.length);
        const price = computed(() => {
            if (cart.value.length) {
                const totalPrice = cart.value.reduce(
                    (acc, course) => acc + parseFloat(course.price),
                    0
                );
                return totalPrice.toFixed(2);
            }
        });
        const discount = computed(() => {
            if (cart.value.length) {
                const totalPrice = cart.value.reduce((acc, course) => {
                    if (course.discount) {
                        return acc + parseFloat(course.discount);
                    }
                    return acc;
                }, 0);
                return totalPrice.toFixed(2);
            }
        });

        const tax = computed(() => {
            const taxRate = 0.075;
            return (taxRate * price.value).toFixed(2);
        });

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
            cartLength,
            cart,
            discount,
            price,
            tax,
            addToCart,
            removeFromCart,
            checkExisting,
        };
    },
    { persist: true }
);
