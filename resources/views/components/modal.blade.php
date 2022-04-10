<!-- This example requires Tailwind CSS v2.0+ -->
<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-data="{ open: false }" x-init="open = true" x-show="open" >
    <div
        class="flex justify-center items-center min-h-screen pt-4 px-4 pb-20 text-center"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform opacity-0"
        x-transition:enter-end="transform opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="transform opacity-100"
        x-transition:leave-end="transform opacity-0"
    >
        <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

{{--        <!-- This element is to trick the browser into centering the modal contents. -->--}}
{{--        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>--}}

        <!--
          Modal panel, show/hide based on modal state.

          Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
        <div
            class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all mx-auto sm:align-middle sm:w-full md:w-2/3 lg:2/6"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="transform opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="transform opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="transform opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-xl leading-6 font-medium text-gray-900 py-2" id="modal-title">
                            বিশেষ বিজ্ঞপ্তি
                        </h3>
                        <div class="mt-2">
                            <p class="text-md text-gray-700">
                                সংশ্লিষ্ট সকলের অবগতির জন্য জানানো যাচ্ছে যে,
                                পবিত্র ঈদুল আযহা উপলক্ষে Brand Shop এর ডেইলি ইনকাম ও
                                উইড্র অদ্য ২০-০৭-২০২১ ইং হইতে ২২-০৭-২০২১ ইং পর্যন্ত বন্ধ
                                থাকিবে, শুধুমাত্র Registration চালু থাকবে । <br/>
                                সবাইকে পবিত্র ঈদুল আযহা এর শুভেচ্ছা
                                <div class="w-full py-1 text-right text-sm">
                                    চেয়ারম্যান<br/>
                                    আতিক চৌধুরী<br/>
                                    ব্র্যান্ড শপ লিঃ
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                x-on:click="open = false"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
