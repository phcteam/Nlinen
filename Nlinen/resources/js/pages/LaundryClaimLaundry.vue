<template>
    บันทึกส่งเครมโรงซัก
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">รับผ้าส่งเครม</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="search-tab" data-bs-toggle="tab" data-bs-target="#search" type="button"
                    role="tab" aria-controls="search" aria-selected="false">ค้นหา</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- Form Inputs -->
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <label for="hospital" class="form-label">โรงพยาบาล</label>
                        <input type="text" id="hospital" class="form-control" v-model="selectedProduct.hospital">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="laundry" class="form-label">โรงงานซัก</label>
                        <input type="text" id="laundry" class="form-control" v-model="selectedProduct.laundry">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="docDate" class="form-label">วันที่เอกสาร</label>
                        <input type="date" id="docDate" class="form-control" v-model="selectedProduct.docDate">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="docNumber" class="form-label">เลขที่เอกสาร</label>
                        <input type="text" id="docNumber" class="form-control" v-model="selectedProduct.docNumber">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="recorder" class="form-label">ผู้บันทึก</label>
                        <input type="text" id="recorder" class="form-control" v-model="selectedProduct.recorder">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="time" class="form-label">เวลาที่บันทึก</label>
                        <input type="time" id="time" class="form-control" v-model="selectedProduct.time">
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-md-6 mb-3">
                        <label for="inputWeight" class="form-label">น้ำหนักรวม</label>
                        <input type="text" id="inputWeight" class="form-control" v-model="selectedProduct.weight">
                    </div>

                    <div class="col-md-6 text-end text-md-start">
                        <div class="d-flex flex-wrap gap-4 justify-content-end mt-3">
                            <div class="text-center">
                                <button class="btn btn-outline-primary rounded-circle"
                                    style="width: 45px; height: 45px;">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <div class="small mt-1">เพิ่ม</div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-secondary rounded-circle"
                                    style="width: 45px; height: 45px;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <div class="small mt-1">แก้ไข</div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-success rounded-circle"
                                    style="width: 45px; height: 45px;">
                                    <i class="fas fa-check"></i>
                                </button>
                                <div class="small mt-1">บันทึก</div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-warning rounded-circle"
                                    style="width: 45px; height: 45px;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <div class="small mt-1">โหลดใหม่</div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-danger rounded-circle"
                                    style="width: 45px; height: 45px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <div class="small mt-1">ลบ</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Table with checkbox -->
                <div class="table-responsive" v-if="products.length">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> </th>
                                <th>ลำดับ</th>
                                <th>แผนก</th>
                                <th>รายการ</th>
                                <th>หน่วยนับ</th>
                                <th>จำนวน</th>
                                <th>น้ำหนัก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in products" :key="product.id">
                                <td>
                                    <input type="radio" v-model="selectedProduct" :value="product" />
                                </td>
                                <td>{{ index + 1 }}</td>
                                <td>{{ product.department }}</td>
                                <td>{{ product.name }}</td>
                                <td><input type="text" class="form-control" v-model="product.unit" /></td>
                                <td><input type="number" class="form-control" v-model.number="product.quantity" /></td>
                                <td><input type="number" class="form-control" v-model.number="product.weight" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-else class="text-center my-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">กำลังโหลด...</span>
                    </div>
                    <p class="mt-2">กำลังโหลดข้อมูล...</p>
                </div>
            </div>
            <div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
                <div class="input-group my-3">
                    <input type="text" class="form-control" placeholder="Search ......"
                        aria-label="Recipient's username">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
import { ref, onMounted } from "vue";

export default {
    setup() {
        const products = ref([]);
        const selectedProducts = ref([]);
        const selectedProduct = ref({
            hospital: "",
            laundry: "",
            docDate: "",
            docNumber: "",
            recorder: "",
            time: "",
            weight: "",
        });

        const fetchProducts = async () => {
            try {
                const response = await fetch("/api/products");
                products.value = await response.json();
            } catch (error) {
                console.error("Error fetching products:", error);
            }
        };

        const selectProduct = (product) => {
            if (selectedProducts.value.includes(product)) {
                selectedProduct.value = { ...product };
            } else {
                selectedProduct.value = {}; // Reset if no product is selected
            }
        };

        onMounted(fetchProducts);

        return { products, selectedProduct, selectedProducts, selectProduct };
    },
};
</script>