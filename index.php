<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data=check_login($con);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gymly</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php
        ($user_data)? include("logged_in_navbar.php") :include ("logged_out_navbar.php");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12 header-title">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 feature">
                    <img src="DALL·E 2024-04-23 21.50.06 - An illustration of a fit, shirtless individual on a beach during summer weather. The character, clearly a gym enthusiast, is wearing swim shorts and s.webp" style="width: 140px; height: 140px;">
                    <h2>Recreation</h2>
                    <p>Stand proud on the beach, your physique sculpted like the individual in our dynamic image. Feel the surge of unshakeable confidence. Here's why that matters:
                    <ul>
                        <li><strong>Confidence Booster:</strong> Exuding assurance with every step, you become the embodiment of dedication and hard work.</li>
                        <li><strong>Outdoor Workouts:</strong> Take your exercise outdoors. The sun, the air, and the sea – it's an invigorating trifecta for mind and body.</li>
                        <li><strong>Ready for Adventure:</strong> With fitness comes freedom. Surf, swim, play – you're ready for any beach activity, any time.</li>
                        <li><strong>Health Impact:</strong> A fit body contributes to overall well-being, from robust immunity to a strong heart.</li>
                        <li><strong>Inspire Others:</strong> Your fitness journey can motivate others to take their first step towards their own.</li>
                        <li><strong>A Moment Captured:</strong> Aesthetics matter. Capture the beauty of your achievements against nature's canvas.</li>
                        <li><strong>Stress Reliever:</strong> Physical activity in nature's lap significantly reduces stress, bringing inner peace.</li>
                    </ul>
                    Embrace your journey towards a formidable physique that's about feeling powerful, poised, and at peace.</p>
                    <button>View details</button>
                </div>
                <div class="col-md-4 feature">
                    <img src="DALL·E 2024-04-23 21.49.53 - A dynamic action shot of an individual lifting weights in a gym setting. The person is focused and engaged in a heavy weightlifting session, showcasin.webp" style="width: 140px; height: 140px;">
                    <h2>Rows</h2>
                    <p>Envision the grit of the man in the image, every lift a testament to power. Here's what strength training brings to your life:
                    <ul>
                        <li><strong>Muscle Sculpting:</strong> Carve out definition with each pull. Activate 85% of your body's muscles for full-body toning.</li>
                        <li><strong>Calorie Burn:</strong> Torching calories, rowing amplifies fat loss and muscle gain for a lean physique.</li>
                        <li><strong>Cardiovascular Boost:</strong> Elevate your heart rate and stamina. Build a body that's durable, inside and out.</li>
                        <li><strong>Joint-Friendly:</strong> Low impact yet high intensity, rowing respects your joints while demanding your all.</li>
                        <li><strong>Core and Posture:</strong> Anchor your body with a solid core. Stand tall, prevent pain, radiate strength.</li>
                        <li><strong>Mental Grit:</strong> Sharpen your focus. Discipline your mind with the rhythm of the row.</li>
                    </ul>
                    Transform with rowing, where every stroke is a stroke of genius.</p>
                    <button>View details</button>
                </div>
                <div class="col-md-4 feature">
                    <img src="DALL·E 2024-04-23 21.48.18 - Generate an image of a man doing a squat with a barbell, realistic style, gym environment, full color.webp" alt="Man doing squat with barbell" style="width: 140px; height: 140px;">
                    <h2>Squat</h2>
                    <p>Embrace the squat – the cornerstone of power. It's more than an exercise; it's a life-changer:
                    <ul>
                        <li><strong>Full-Body Workout:</strong> Squats target multiple muscle groups for comprehensive strength and toning.</li>
                        <li><strong>Calorie Incinerator:</strong> Fire up your metabolism. Burn more, build more, be more.</li>
                        <li><strong>Balance and Mobility:</strong> Cultivate grace in power. Enhance your body's harmony and movement.</li>
                        <li><strong>Postural Perfection:</strong> Build a back that bears the world. Elevate your stance in work and play.</li>
                        <li><strong>Bone Density:</strong> Fortify your frame. Grow stronger, stand sturdier, age with confidence.</li>
                    </ul>
                    Let every squat lift your spirit as much as your strength. Power is a choice—choose to rise.</p>
                    <button>View details</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 footer-text">
                    <p>Stride through life with the confidence of the poised figure in our image. In fitness as in fashion, what's beneath counts:
                    <ul>
                        <li><strong>Elegance in Strength:</strong> Let your physique be your finest attire. Elegance isn't worn, it's embodied.</li>
                        <li><strong>Discipline's Tale:</strong> Your build narrates a story of resolve. It whispers of early mornings and late gym sessions.</li>
                        <li><strong>Commanding Presence:</strong> Walk into any room, and own it. A sculpted body speaks volumes before a word is uttered.</li>
                        <li><strong>Amplified Appeal:</strong> Transcend trends with timeless strength. Let your form be your most captivating feature.</li>
                        <li><strong>A Portrait of Health:</strong> Your commitment reflects in your posture, your pace, your presence. It's a living, breathing testament to the life you choose.</li>
                        <li><strong>Quiet Confidence:</strong> With a body honed by sweat and perseverance, let confidence be your silent, steadfast companion.</li>
                    </ul>
                    Be the protagonist of your own story. Command the scene. Not just fit, but a fitness maestro.</p>

                </div>
            </div>
            <div class="row">
                <div class="col-12 large-image">
                    <img src="DALL·E 2024-04-23 21.50.17 - An illustration of a fit individual, clearly a gym enthusiast, fully clothed in a rustic town square. The character is wearing a stylish casual outfit.webp" alt="Large feature">
                </div>
            </div>
            <div class="row">
                <div class="col-12 footer-text">
                    <p>Picture yourself striding with purpose through a vibrant cityscape, each step a reflection of unyielding confidence and the spirit of a trailblazer. The individual in the image is more than a figure in a crowd; they're a testament to what discipline and fitness can sculpt—poise and reliability woven into their very presence. Here's what this powerful image symbolizes for you:
                    <ul>
                        <li><strong>Symbol of Success:</strong> The tailored lines of a suit complement the musculature underneath, showcasing a body shaped by dedication—a silent announcement of a person ready to take on the world.</li>
                        <li><strong>Commitment Personified:</strong> Your muscular stature isn't merely seen—it's felt. It speaks a story of perseverance, of routines mastered, and excellence achieved. It's the embodiment of a professional who brings the strength of the gym to every business challenge.</li>
                        <li><strong>Presence That Speaks:</strong> Command attention without a word. Your fitness level is a powerful communicator in the boardroom, conveying that you're as robust in strategy as you are in strength.</li>
                        <li><strong>Amplified Elegance:</strong> Your build is the ultimate accent to your wardrobe. Transform any occasion with your formidable presence, harmonizing with the finest garments and the grandest settings.</li>
                        <li><strong>Reliability Reflected:</strong> Your muscular form mirrors a work ethic of iron, a visual commitment to goals met and exceeded, in the gym, in business, in every endeavor.</li>
                        <li><strong>Magnetic Confidence:</strong> Fitness breeds a compelling confidence, a force that influences, attracts success, and leads with quiet authority.</li>
                    </ul>
                    Embrace the fitness journey, let it be your second skin, and ascend to the zenith of your potential. Engage with your well-being, and elevate every aspect of your existence. Start today.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 large-image">
                    <img src="DALL·E 2024-04-23 21.50.24 - An illustration of a fit individual, clearly a regular at the gym, dressed in a sharp suit standing outside of a skyscraper. The character exudes a pr.webp" alt="Large feature">
                </div>
            </div>
        </div>
        <?php include("footer.php")?>
    </body>
</html>
