<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary" @click="openModal">Nuevo producto</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-3 mx-2">
					<table class="table table-bordered" id="product_table">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Descripcion</th>
								<th>Color</th>
								<th>Stock</th>
								<th>categoria</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(product, index) in products" :key="index">
								<td>{{ product.name }}</td>
								<td>{{ product.price }}</td>
								<td>{{ product.format_description }}</td>
								<td>{{ product.color }}</td>
								<td>{{ product.stock }}</td>
								<td>{{ product.category.name }}</td>
								<td>
									<div class="d-flex justify-content-center">
										<button type="button" class="btn btn-warning" title="Editar"
											@click="editProduct(product)">
											<i class="fa-solid fa-pencil"></i>
										</button>
										<button type="button" class="btn btn-danger ms-2" title="Eliminar"
											@click="deleteProduct(product)">
											<i class="fa-solid fa-trash-can"></i>
										</button>
									</div>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
			<div>
				<product-modal ref="product_modal" :product_data="product"
					:categories_data="categories" />
			</div>
		</div>
	</section>
</template>
<script>

import ProductModal from './ProductModal.vue';
import { deleteMessage, successMessage } from '@/helpers/Alert.js'

export default {
	components: {
		ProductModal
	},
	name: '',
	props: ['products', 'categories'],

	data() {
		return {
			modal: null,
			product: {}
		}
	},
	mounted() {
		this.index()
	},
	methods: {
		async index() {
			$('#product_table').DataTable({
				scrollX: true,
				order: [[0, 'asc']],
				autoWidth: false,
				dom: 'Bfrtip',
				buttons: ['pageLength', 'excel', 'pdf', 'copy'],
			});
			const modal_id = document.getElementById('product_modal')
			this.modal = new bootstrap.Modal(modal_id)
			modal_id.addEventListener('hidden.bs.modal', e => {
				this.$refs.product_modal.reset();
			})
		},
		editProduct(product) {
			this.product = product
			this.openModal()
		},
		async deleteProduct({ id }) {
			if (!await deleteMessage()) return
			try {
				await axios.delete(`/products/${id}`)
				await successMessage({ is_delete: true, reload: true })
			} catch (error) {
				console.error(error);
			}
		},
		async openModal() {
			this.modal.show()
		},
	}
}
</script>

