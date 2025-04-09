<template>
        <h2>Product List</h2>
        <ul v-if="products.length">
            <li v-for="product in products" :key="product.id">
                {{ product.name }} - ฿{{ product.price }}
            </li>
        </ul>
        <p v-else>Loading...</p>
</template>

<script>
import { ref, onMounted } from "vue";

export default {
    setup() {
        const products = ref([]);

        const fetchProducts = async () => {
            try {
                const response = await fetch("/api/products");
                products.value = await response.json();
            } catch (error) {
                console.error("Error fetching products:", error);
            }
        };

        onMounted(fetchProducts);

        return { products };
    },
};
</script>