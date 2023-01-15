<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Section 1 --}}
            <section class="py-20 md:px-0">
                <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
                  <div class="flex flex-wrap items-center sm:-mx-3">
                    <div class="w-full md:w-1/2 md:px-3">
                      <div class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                          <span class="block text-green-500 xl:inline">Lorem Ipsum Dolor Sit Amet.</span>
                        </h1>
                        <p class="mx-auto text-base text-gray-400 sm:max-w-md lg:text-xl md:max-w-3xl">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias quia consectetur ad quaerat doloribus aliquid?</p>
                        <div class="relative flex flex-col sm:flex-row sm:space-x-4">
                          <a href="#_" class="flex items-center w-full px-6 py-3 mb-3 text-lg text-white bg-green-600 rounded-xl sm:mb-0 hover:bg-green-700 sm:w-auto">
                            Join Our Forums
                          </a>
                          {{-- <a href="#_" class="flex items-center px-6 py-3 text-gray-500 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-gray-600">
                            Learn More
                          </a> --}}
                        </div>
                      </div>
                    </div>
                    <div class="w-full md:w-1/2">
                      <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
                          <img src="https://images.unsplash.com/photo-1498049860654-af1a5c566876?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80">
                        </div>
                    </div>
                  </div>
                </div>
            </section>

            {{-- Section 2 --}}
            <section class="w-full pt-7 pb-7 md:pt-20 md:pb-24">
                <div class="box-border flex flex-col items-center content-center px-8 mx-auto leading-6 text-white border-0 border-gray-300 border-solid md:flex-row max-w-7xl lg:px-16">
            
                    <!-- Image -->
                    <div class="box-border relative w-full max-w-md px-4 mt-5 mb-4 -ml-5 text-center bg-no-repeat bg-contain border-solid md:ml-0 md:mt-0 md:max-w-none lg:mb-0 md:w-1/2 xl:pl-10">
                        <img src="https://cdn.devdojo.com/images/december2020/productivity.png" class="p-2 pl-6 pr-5 xl:pl-16 xl:pr-20 ">
                    </div>
            
                    <!-- Content -->
                    <div class="box-border order-first w-full text-white border-solid md:w-1/2 md:pl-10 md:order-none">
                        <h2 class="m-0 text-xl font-semibold leading-tight border-0 border-gray-300 lg:text-3xl md:text-2xl">
                            Boost Productivity
                        </h2>
                        <p class="pt-4 pb-8 m-0 leading-7 text-gray-500 border-0 border-gray-300 sm:pr-12 xl:pr-32 lg:text-lg">
                            Build an atmosphere that creates productivity in your organization and your company culture.
                        </p>
                        <ul class="p-0 m-0 leading-6 border-0 border-gray-300">
                            <li class="box-border relative py-1 pl-0 text-left text-gray-400 border-solid">
                                <span class="inline-flex items-center justify-center w-6 h-6 mr-2 text-white bg-yellow-300 rounded-full"><span class="text-sm font-bold">✓</span></span> Maximize productivity and growth
                            </li>
                        </ul>
                    </div>
                    <!-- End  Content -->
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
