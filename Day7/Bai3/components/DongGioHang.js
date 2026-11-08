export default {
    name :'DongGioHang',
    props: {
        id: {
            type: [Number, String],
            required: true
        },
        ten: {
            type: String,
            required: true
        },
        donGia: {
            type: Number,
            required: true
        },
        soLuong: {
            type: Number,
            required: true
        }
    },
    // khai báo và phát các sự kiện
    emits: ['doi-so-luong', 'yeu-cau-xoa'],
    computed: {
        thanhTien() {
            return this.donGia * this.soLuong;
        }
    },
    methods: {
        giamSoLuong() {
            if (this.soLuong > 1){
                this.$emit('doi-so-luong', this.id, this.soLuong - 1);
            }
        },
        tangSoLuong() {
            if (this.soLuong < 99){
                this.$emit('doi-so-luong', this.id, this.soLuong + 1);
            }
        },
        xoaSanPham() {
            this.$emit('yeu-cau-xoa', this.id);
        },
        formatCurrency(value) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
        }
    },
    template:`
        <tr>
            <td>{{ id }}</td>
            <td>{{ ten }}</td>
            <td>{{ formatCurrency(donGia) }}</td>
            <td>
                <div class="quantity-controls">
                    <button @click="giamSoLuong" :disabled="soLuong <= 1">-</button>
                    <span class="qty-number">{{ soLuong }}</span>
                    <button @click="tangSoLuong" :disabled="soLuong >= 99">+</button>
                </div>
            </td>
            <td>{{ formatCurrency(thanhTien) }}</td>
            <td>
                <button class="btn-delete" @click="xoaSanPham">Xoá</button>
            </td>
        </tr>
        `
};