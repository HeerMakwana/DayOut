<?php
include 'header.php';
?>

<style>
.button-blue {
    background-color: rgb(143, 181, 248); /* blue */
    color: white;
    padding: 15px 30px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    transition: all 0.3s ease;
}

.button-blue:hover {
    background-color: white;
    color:rgb(143, 181, 248);
     /* darker blue */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    transform: translateY(-3px);
}
</style>


<div class="hero-section">
    <div class="hero-content">
        <h1>Discover Your Perfect DayOut</h1>
        <p>Let AI craft your ideal itinerary.</p>
        <a href="register.php" class="button-blue" >Get Started</a>
    </div>
    <div class="floating-elements">
        <div class="floating-circle circle-1"></div>
        <div class="floating-circle circle-2"></div>
        <div class="floating-circle circle-3"></div>
        <div class="floating-circle circle-4"></div>
    </div>
</div>

<div class="features-section">
    <h2>Why Choose DayOut?</h2>
    <div class="features-container">
        <div class="feature-card">
            <h3>Personalized Itineraries</h3>
            <p>AI-driven recommendations tailored to your preferences.</p>
        </div>
        <div class="feature-card">
            <h3>Save Time</h3>
            <p>Skip the hours of planning and get straight to enjoying your day.</p>
        </div>
        <div class="feature-card">
            <h3>Discover New Places</h3>
            <p>Explore hidden gems and popular destinations with ease.</p>
        </div>
    </div>
</div>

<div class="testimonials-section">
    <h2>What Our Users Say</h2>
    <div class="testimonial-carousel">
        <div class="testimonial-slide active">
            <p>"DayOut made planning my trip so easy! I loved the personalized itinerary!"</p>
            <p>- Sarah J.</p>
        </div>
        <div class="testimonial-slide">
            <p>"I discovered places I would have never found on my own. Highly recommend!"</p>
            <p>- Mark T.</p>
        </div>
        <div class="testimonial-slide">
            <p>"The AI suggestions were spot on! Perfect mix of activities and relaxation."</p>
            <p>- Emily R.</p>
        </div>
        <div class="testimonial-slide">
            <p>"Saved me hours of research and delivered an amazing vacation plan."</p>
            <p>- David K.</p>
        </div>
        <div class="testimonial-slide">
            <p>"The itinerary was perfectly paced with great restaurant recommendations."</p>
            <p>- Lisa M.</p>
        </div>
    </div>
    <div class="carousel-navigation">
        <button class="carousel-prev">❮</button>
        <div class="carousel-indicators"></div>
        <button class="carousel-next">❯</button>
    </div>
</div>

<?php
include 'footer.php';
?>
<script src="assets/js/carousel.js" defer></script>
</body>
</html>