@extends('layouts.app')

@section('title', 'Tambah Pesanan')

@section('content')
    <h1 class="h3">Tambah Pesanan</h1>

    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Pelanggan</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->customer_id }}">{{ $customer->username }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="order_date" class="form-label">Tanggal Pesan</label>
            <input type="date" class="form-control" id="order_date" name="order_date" value="{{ old('order_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Pesanan</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <h4>Detail Pesanan</h4>
        <div id="orderDetailsContainer">
            <div class="card mb-3" id="orderDetail_1">
                <div class="card-header">
                    <strong>Detail Produk 1</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="product_id_1" class="form-label">Produk</label>
                        <select class="form-control" id="product_id_1" name="order_details[0][product_id]" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->product_id }}" data-price="{{ $product->price }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity_1" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="quantity_1" name="order_details[0][quantity]" required>
                    </div>

                    <div class="mb-3">
                        <label for="price_1" class="form-label">Harga</label>
                        <input type="number" step="0.01" class="form-control" id="price_1" name="order_details[0][price]" required readonly>
                    </div>

                    <div class="mb-3">
                        <label for="subtotal_1" class="form-label">Subtotal</label>
                        <input type="number" step="0.01" class="form-control" id="subtotal_1" name="order_details[0][subtotal]" readonly>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm" onclick="removeOrderDetail(1)">Hapus Detail</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Total Harga</label>
            <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" required readonly>
        </div>
        
        <button type="button" class="btn btn-secondary" id="addOrderDetail">Tambah Detail Produk</button>
        <button type="submit" class="btn btn-primary mt-3">Simpan Pesanan</button>
    </form>

    <script>
        let orderDetailsCount = 1;

        document.getElementById('addOrderDetail').addEventListener('click', function() {
            const orderDetailsContainer = document.getElementById('orderDetailsContainer');
            orderDetailsCount++;

            const newDetail = document.createElement('div');
            newDetail.classList.add('card', 'mb-3');
            newDetail.id = `orderDetail_${orderDetailsCount}`;
            newDetail.innerHTML = `
                <div class="card-header">
                    <strong>Detail Produk ${orderDetailsCount}</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="product_id_${orderDetailsCount}" class="form-label">Produk</label>
                        <select class="form-control" id="product_id_${orderDetailsCount}" name="order_details[${orderDetailsCount - 1}][product_id]" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->product_id }}" data-price="{{ $product->price }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity_${orderDetailsCount}" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="quantity_${orderDetailsCount}" name="order_details[${orderDetailsCount - 1}][quantity]" required>
                    </div>

                    <div class="mb-3">
                        <label for="price_${orderDetailsCount}" class="form-label">Harga</label>
                        <input type="number" step="0.01" class="form-control" id="price_${orderDetailsCount}" name="order_details[${orderDetailsCount - 1}][price]" required readonly>
                    </div>

                    <div class="mb-3">
                        <label for="subtotal_${orderDetailsCount}" class="form-label">Subtotal</label>
                        <input type="number" step="0.01" class="form-control" id="subtotal_${orderDetailsCount}" name="order_details[${orderDetailsCount - 1}][subtotal]" readonly>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm" onclick="removeOrderDetail(${orderDetailsCount})">Hapus Detail</button>
                </div>
            `;

            orderDetailsContainer.appendChild(newDetail);
        });

        function removeOrderDetail(id) {
            const detail = document.getElementById(`orderDetail_${id}`);
            detail.remove();
            updateTotalPrice();
        }

        // Fungsi untuk menghitung dan mengupdate harga dan subtotal
        function updatePrices() {
            let totalPrice = 0;
            for (let i = 1; i <= orderDetailsCount; i++) {
                const productSelect = document.getElementById(`product_id_${i}`);
                const quantityInput = document.getElementById(`quantity_${i}`);
                const priceInput = document.getElementById(`price_${i}`);
                const subtotalInput = document.getElementById(`subtotal_${i}`);

                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const productPrice = parseFloat(selectedOption.getAttribute('data-price'));
                const quantity = parseInt(quantityInput.value);

                if (quantity && !isNaN(quantity)) {
                    const subtotal = productPrice * quantity;
                    priceInput.value = productPrice;
                    subtotalInput.value = subtotal.toFixed(2);
                    totalPrice += subtotal;
                }
            }

            // Update total price
            document.getElementById('total_price').value = totalPrice.toFixed(2);
        }

        // Tambahkan event listener untuk input jumlah dan produk
        document.addEventListener('input', function(event) {
            if (event.target.matches('[id^="quantity_"], [id^="product_id_"]')) {
                updatePrices();
            }
        });

        // Initial call to update prices
        updatePrices();
    </script>
@endsection
