<div class="bg-blue-500">

<div class="container card border border-yellow-900 lg:mx-1 m-1 p-8">
    <div class="w-full card card  border-yellow-900 bg-white shadow-md p-8">
        <h1 class="text-2xl font-bold text-yellow-900 text-center  mb-4">Welcome to JAZAKH-ALLAH VENTURES</h1>

        <p class="text-lg text-blue-800 leading-loose">
            JAZAKH-ALLAH VENTURES is your trusted partner for all your construction needs. We specialize in the sales and hiring of top-quality machines and a wide range of building materials. Whether you are planning a small DIY project or undertaking a large-scale construction endeavor, we have the tools and materials you need to bring your vision to life.
        </p>

        <p class="text-lg text-blue-800 leading-loose mt-4">
            Our commitment to excellence, reliability, and customer satisfaction sets us apart in the industry. Explore our extensive inventory of construction machinery and high-quality building materials to ensure the success of your projects. At JAZAKH-ALLAH VENTURES, we are dedicated to providing you with the best solutions for your construction requirements.
        </p>

        <p class="text-lg text-blue-800 leading-loose mt-4">
            Contact us today to discuss your project needs, and let us be your partner in success. Trust JAZAKH-ALLAH VENTURES for all your sales and hiring needs in the construction and building materials industry.
        </p>
    </div>
</div>


        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 p-8 gap-2">
            <!-- Loop through images with names -->
            @foreach(['cement' => 'Cement', 'ma' => 'Road constructions', 'pic' => 'Other materials', 'mach1' => 'Machines', 'petrol' => 'petrol', 'pet' => 'Fuel for sale', 'wel' => 'Wheel barrows', 'wel2' => 'Rentals', 'li' => 'Others'] as $imageName => $imageCaption)
                <div class="flex text-blue-500 flex-col items-center mb-4">
                    <img src="images/{{ $imageName }}.jpg" alt="{{ $imageName }}" class="w-full text-white h-64 object-cover object-center rounded-md">
                    <p class="text-lg text-blue-800 leading-loose mt-2">{{ $imageCaption }}</p>
                </div>
            @endforeach

    </div>
</div>
