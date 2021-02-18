<script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.5.2/vue.min.js"></script>
<!-- CDNJS :: Sortable (https://cdnjs.com/) -->
<script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>
<!-- CDNJS :: Vue.Draggable (https://cdnjs.com/) -->
<script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>

<div class="box mb" id="ctt-form">
	<div class="tbl-ctrls">
		<nav>
			<h1>Category Taxonomy Tree</h1>
		</nav>
		<table id="ctt-ui" class="ctt-table" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>
						<h2>Categories</h2>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<draggable style="min-height: 200px;" class="page-ui page-list" v-model="categories">
							<li
								class="page-item"
								v-for="category in categories"
								:key="category.id"
							>
								<div class="item-wrapper">
									<div class="item-inner">
										<span class="page-handle drag-handle">
											<a href="#">Move</a>
										</span>
										<span class="page-title"></span>
										{{category.name}}
									</div>
								</div>
							</li>
						</draggable>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<script>
	const app = new Vue({
		el: '#ctt-form',
		data: function () {
			return {
				isLoaded: false,
				categories: <?php echo json_encode($categories); ?>,
				saveUrl: "<?php echo $save_url; ?>",
				drag: false
			}
		},
		methods: {
			saveSettings: function () {

				var categories = this.categories.map(function(c) {return c.id}).join('|')

				var sendData = {
					categories: categories,
					csrf_token: EE.CSRF_TOKEN
				}

				$.ajax({
					url: this.saveUrl,
					method: "POST",
					data: sendData,
					datatype: "json"
				}).done(function() {
					console.log('Saved');
				});
			}
		},
		watch: {
			categories(n,o) {
				this.saveSettings()
			}
		}
	});
</script>