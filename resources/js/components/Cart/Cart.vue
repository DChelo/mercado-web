<template>
	<div class="cart-container">
		<h1 class="cart-title text-center">Carrito de Compras</h1>

		<div class="cart-items">
			<div v-for="(product, productId) in cart" :key="productId" class="cart-item">
				<div class="cart-item-details">
					<h4 class="cart-item-name">{{ product.name }}</h4>
					<p class="h4 cart-item-price">$ {{ product.price }}</p>
					<p class="cart-item-total d-flex justify-content-center">Total:$<strong>{{ product.price *
						product.quantity }}</strong></p>
					<div class="cart-item-quantity">
						<p>Cantidad:</p>
						<button class="btn btn-sm btn-secondary" @click="decreaseQuantity(productId)">-</button>
						<span class="quantity ">{{ product.quantity }}</span>
						<button class="btn btn-sm btn-secondary" @click="increaseQuantity(productId)">+</button>
					</div>
				</div>
			</div>
			<p v-if="Object.keys(cart).length === 0">El carrito está vacío.</p>
		</div>

		<button class="btn btn-danger cart-clear" @click="clearCart">Vaciar carrito</button>
	</div>
</template>

<script>
export default {
	props: {
		userId: {
			type: String,
			required: true
		}
	},
	data() {
		return {
			cart: {},
		};
	},
	methods: {
		displayCartItems() {
			const cartData = JSON.parse(localStorage.getItem(`cart_${this.userId}`)) || {};
			this.cart = cartData;
		},
		increaseQuantity(productId) {
			this.cart[productId].quantity++;
			this.updateLocalStorage();
		},
		decreaseQuantity(productId) {
			if (this.cart[productId].quantity > 1) {
				this.cart[productId].quantity--;
				this.updateLocalStorage();
			}
		},
		updateLocalStorage() {
			localStorage.setItem(`cart_${this.userId}`, JSON.stringify(this.cart));
		},
		clearCart() {
			if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
				localStorage.removeItem(`cart_${this.userId}`);
				this.cart = {};
				alert('El carrito ha sido vaciado.');
			}
		}
	},
	created() {
		if (this.userId) {
			this.displayCartItems();
		}
	}
};
</script>

<style scoped>
body {
	font-family: Arial, sans-serif;
	background-color: #f5f5f5;
}

.cart-container {
	background-color: #fff;
	border-radius: 8px;
	box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
	padding: 20px;
	max-width: 800px;
	margin: 0 auto;
}

.cart-items {
	border-top: 1px solid #ddd;
	margin-top: 20px;
	padding-top: 20px;
}

.cart-item {
	display: flex;
	align-items: center;
	border-bottom: 1px solid #ddd;
	padding: 20px 0;
}

.cart-item-details {
	flex: 1;
	margin-left: 20px;
}

.cart-item-name {
	font-size: 25px;
	font-weight: bold;
}

.cart-item-price {
	font-size: 30px;
	color: #333;
}

.cart-item-quantity {
	margin-top: 10px;
	font-size: 20px;
}

.btn-quantity {
	font-size: 18px;
	width: 30px;
	height: 30px;
	background-color: #f2f2f2;
	border: 1px solid #ddd;
	color: #333;
}

.quantity {
	font-size: 19px;
	margin: 10px;
	color: #333;
}

.cart-item-total {
	margin-left: 500px;
	font-size: 30px;
}

.cart-clear {
	margin-left: 310px;
	background-color: #e74c3c;
	border: none;
	color: #fff;
	padding: 10px 20px;
	border-radius: 4px;
	cursor: pointer;
	transition: background-color 0.3s ease;
	margin-top: 20px;
}

.cart-clear:hover {
	background-color: #c0392b;
}
</style>
