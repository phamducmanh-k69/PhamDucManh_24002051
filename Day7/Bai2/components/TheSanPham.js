export default {
    name: 'TheSanPham',
    props: {
        ten: {
            type: String,
            required: true
        },
        gia: {
            type: Number,
            required: true
        },
        anh: {
            type: String,
            required: true
        },
        moTa: {
            type: String,
            default: "Chưa có mô tả chi tiết"
        },
        soLuongTon: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            hienMoTa: false
        }
    },
    methods: {
        formatCurrency(value) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND'}).format(value);
        }
    },
    template: `
        <div class="product-card">
            <img :src="anh" :alt="ten" class="product-img">
            <div class="product-info">
                <h3>{{ ten }}</h3>
                <p class="price">Giá: {{ formatCurrency(gia) }}</p>
                <p>Còn lại: {{ soLuongTon }}</p>
                <div v-if="soLuongTon === 0" class="out-of-stock-label">Hết hàng</div>
                <button class="btn btn-info" @click="hienMoTa = !hienMoTa">
                    {{ hienMoTa ? 'Ẩn' : 'Xem' }} Mô Tả
                </button>
                <div v-show="hienMoTa" class="description-box">
                    {{ moTa }}
                </div>
                <button class="btn btn-buy" :disabled="soLuongTon === 0">
                    {{ soLuongTon === 0 ? 'Đã khoá mua' : 'Mua ngay' }}
                </button>
            </div>
        </div>
    `
}