<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary" @click="openModal">Nueva categoria</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-3 mx-2">
					<table class="table table-bordered" id="category_table">
						<thead>
							<tr>
								<th>Nombre</th>
								<th class="d-flex justify-content-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(category, index) in categories" :key="index">
								<td>{{ category.name }}</td>
								<td>
									<div class="d-flex justify-content-center">
										<button type="button" class="btn btn-warning" title="Editar"
											@click="editCategory(category)">
											<i class="fa-solid fa-pencil"></i>
										</button>
										<button type="button" class="btn btn-danger ms-2" title="Eliminar"
											@click="deleteCategory(category)">
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
				<category-modal ref="category_modal" :categories_data="category" />
			</div>
		</div>
	</section>
</template>
<script>

import CategoryModal from './CategoryModal.vue';
import { deleteMessage, successMessage } from '@/helpers/Alert.js'

export default {
	components: {
		CategoryModal
	},
	name: '',
	props: ['categories'],

	data() {
		return {
			modal: null,
			category: {}
		}
	},
	mounted() {
		this.index()
	},
	methods: {
		async index() {
			$('#category_table').DataTable({
				scrollX: true,
				order: [[0, 'asc']],
				autoWidth: false,
				dom: 'Bfrtip',
				buttons: ['pageLength', 'excel', 'pdf', 'copy'],
			});

			const modal_id = document.getElementById('category_modal')
			this.modal = new bootstrap.Modal(modal_id)
			modal_id.addEventListener('hidden.bs.modal', e => {
				this.$refs.category_modal.reset();
			})
		},
		editCategory(category) {
			this.category = category
			this.openModal()
		},
		async deleteCategory({ id }) {
			if (!await deleteMessage()) return
			try {
				await axios.delete(`/categories/${id}`)
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

