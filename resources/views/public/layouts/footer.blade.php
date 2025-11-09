<!-- resources/views/public/layouts/footer.blade.php -->
    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4>About Us</h4>
                        <p>Our company offers a wide range of products with the best quality and customer service. We are dedicated to providing an exceptional shopping experience for our customers.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4>Contact</h4>
                        <ul>
                            <li>Phone: 123-456-789</li>
                            <li>Email: support@secloth.com</li>
                            <li>Address: 123 Street Name, City</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="{{ url('/about') }}">About Us</a></li>
                            <li><a href="{{ url('/shop') }}">Shop</a></li>
                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                            <li><a href="{{ url('/blog') }}">Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Copyright Section Begin -->
    <div class="copyright-section">
        <div class="container">
            <p>&copy; 2024 SECLOTH. All rights reserved.</p>
        </div>
    </div>
    <!-- Copyright Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('ecomerce/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ecomerce/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('ecomerce/js/main.js') }}"></script>
</body>
</html>
