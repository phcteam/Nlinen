<template>
    บันทึกผ้าใหม่ส่งซัก
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">ผ้าใหม่ส่งซัก</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="search-tab" data-bs-toggle="tab" data-bs-target="#search" type="button"
                    role="tab" aria-controls="search" aria-selected="false">ค้นหา</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <label for="hospital" class="form-label">โรงพยาบาล</label>
                        <input type="text" id="hospital" class="form-control" v-model="selectedNewlinen.HptCode">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="laundry" class="form-label">โรงงานซัก</label>
                        <input type="text" id="laundry" class="form-control" v-model="selectedNewlinen.FacCode">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="docDate" class="form-label">วันที่เอกสาร</label>
                        <input type="date" id="docDate" class="form-control" v-model="selectedNewlinen.DocDate">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="docNumber" class="form-label">เลขที่เอกสาร</label>
                        <input type="text" id="docNumber" class="form-control" v-model="selectedNewlinen.DocNo">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="recorder" class="form-label">ผู้บันทึก</label>
                        <input type="text" id="recorder" class="form-control" v-model="selectedNewlinen.HptCode">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="time" class="form-label">เวลาที่บันทึก</label>
                        <input type="time" id="time" class="form-control" v-model="selectedNewlinen.HptCode">
                    </div>
                </div>

                <div class="row align-items-end">
                    <div class="col-md-6 mb-3">
                        <label for="inputWeight" class="form-label">น้ำหนักรวม</label>
                        <input type="text" id="inputWeight" class="form-control" v-model="selectedNewlinen.weight">
                    </div>

                    <div class="col-md-6 text-end text-md-start">
                        <div class="d-flex flex-wrap gap-4 justify-content-end mt-3">
                            <div class="text-center">
                                <button @click="saveNewLinen" class="btn btn-outline-primary rounded-circle"
                                    style="width: 45px; height: 45px;">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <div class="small mt-1">เพิ่ม</div>
                            </div>
                            <div class="text-center">
                                <button @click="updateNewLinen" class="btn btn-outline-secondary rounded-circle"
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
                                <button @click="deleteNewLinen" class="btn btn-outline-danger rounded-circle"
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
                <div class="table-responsive" v-if="newLinens.length">
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
                            <tr v-for="(newLinen, index) in newLinens" :key="newLinen.id">
                                <td>
                                    <input type="radio" v-model="selectedNewlinen" :value="newLinen" />
                                </td>
                                <td>{{ index + 1 }}</td>
                                <td>{{ newLinen.DocNo }}</td>
                                <td>{{ newLinen.HptCode }}</td>
                                <td><input type="text" class="form-control" v-model="newLinen.FacCode" /></td>
                                <td><input type="number" class="form-control" v-model.number="newLinen.SignFac" /></td>
                                <td><input type="number" class="form-control" v-model.number="newLinen.SignFacTime" />
                                </td>
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
        <div class="mt-4">
            <h3>เซ็นชื่อ:</h3>
            <canvas ref="canvasRef" width="400" height="200" style="border:1px solid #ccc;"></canvas>
            <div class="mt-2">
                <button @click="saveSignature" class="btn btn-success">บันทึกลายเซ็น</button>
                <!-- <button @click="() => signaturePad.clear()" class="btn btn-warning mx-2">ล้าง</button> -->
                <button @click="clearSignature" class="btn btn-warning mx-2">ล้าง</button>

            </div>
        </div>
    </div>

</template>

<script>
import { ref, onMounted } from "vue";
import SignaturePad from 'signature_pad'

export default {
    setup() {
        const newLinens = ref([]);
        const selectedNewlinens = ref([]);
        const selectedNewlinen = ref({
            DocNo: "",
            DocDate: "",
            HptCode: "",
            IsStatus: "",
            FacCode: "",
            SignFac: "",
            SignNH: "",
            SignFacTime: "",
            SignNHTime: "",
        });

        const fetchNewLinen = async () => {
            try {
                const response = await fetch("/api/newlinen");
                newLinens.value = await response.json();
            } catch (error) {
                console.error("Error fetching linen:", error);
            }
        };

        const selectNewlinen = (newLinen) => {
            if (selectedNewlinens.value.includes(newLinen)) {
                selectedNewlinen.value = { ...newLinen };
            } else {
                selectedNewlinen.value = {}; // Reset if no product is selected
            }
        };

        const saveNewLinen = async () => {
            try {
                const response = await fetch("/api/newlinen", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(selectedNewlinen.value),
                });

                const result = await response.json();
                console.log("Saved:", result);

                await fetchNewLinen(); // reload new data
            } catch (error) {
                console.error("Error saving linen:", error);
            }
        };

        const updateNewLinen = async () => {
            if (!selectedNewlinen.value.id) {
                console.warn("No ID provided for update.");
                return;
            }

            try {
                const response = await fetch(`/api/newlinen/${selectedNewlinen.value.id}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(selectedNewlinen.value),
                });

                const result = await response.json();
                console.log("Updated:", result);

                await fetchNewLinen();
            } catch (error) {
                console.error("Error updating linen:", error);
            }
        };

        const deleteNewLinen = async (id) => {
            if (!id) {
                console.warn("No ID provided for delete.");
                return;
            }

            try {
                const response = await fetch(`/api/newlinen/${id}`, {
                    method: "DELETE",
                });

                if (response.ok) {
                    console.log("Deleted:", id);
                    await fetchNewLinen();
                } else {
                    const errorData = await response.json();
                    console.error("Error deleting:", errorData);
                }
            } catch (error) {
                console.error("Error deleting linen:", error);
            }
        };

        // ======================== ลายเซ็น ========================
        const canvasRef = ref(null)
        const signaturePad = ref(null)

        const saveSignature = async () => {
            if (!signaturePad.value || signaturePad.value.isEmpty()) {
                alert('กรุณาเซ็นก่อน');
                return;
            }

            const dataUrl = signaturePad.value.toDataURL('image/png');

            try {
                const response = await fetch('/api/save-signature', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    },
                    body: JSON.stringify({ image: dataUrl }),
                });

                const data = await response.json();

                if (response.ok) {
                    alert('บันทึกลายเซ็นเรียบร้อยแล้ว');
                    console.log(data);
                } else {
                    console.error('เกิดข้อผิดพลาด:', data);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        };


        const clearSignature = () => {
            if (signaturePad.value) {
                signaturePad.value.clear();
            }
        }

        // onMounted(fetchNewLinen);
        onMounted(() => {
            fetchNewLinen();
            signaturePad.value = new SignaturePad(canvasRef.value);

        });

        return {
            newLinens,
            selectedNewlinen,
            selectedNewlinens,
            selectNewlinen,
            saveNewLinen,
            updateNewLinen,
            deleteNewLinen,
            canvasRef,
            clearSignature,
            saveSignature,

        };
    },
};
</script>

<style scoped>
canvas {
    border: 1px solid #ccc;
}
</style>