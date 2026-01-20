<!-- HERO -->

<section class="md:pt-10 pb-6">
    <div x-data="heroslider" class="relative flex items-center justify-center gap-6">
      <button type="button" @click="swiper.slidePrev()"
        class="size-12 hidden 2xl:flex justify-center items-center text-neutral-4 bg-white transition-colors duration-200 hover:bg-neutral-2 rounded-full">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 16" fill="currentColor" width="8px">
          <path d="M9 14.666L7.554 16 0 8l7.554-8L9 1.334 2.706 8z"></path>
        </svg>
      </button>

      <div class="max-w-[calc(100%-30px)] sm:max-w-[calc(100%-80px)] lg:max-w-[996px] w-full">
        <div x-ref="swiper"
          class="swiper [--swiper-pagination-bullet-inactive-color:#c2ced1] [--swiper-pagination-color:#ffffff]">
          <div class="swiper-wrapper">
            <template x-for="(slide,index) in slides" :key="index">
              <div class="swiper-slide">
                <a :href="slide.link" class="block">
                  <article
                    class="banner h-[320px] md:rounded-3xl bg-[#1d1d1d] relative flex flex-col w-full justify-end overflow-hidden">
                    <picture>
                      <source :srcset="slide.desktop_thumbnail_webp" media="(min-width: 640px)" />
                      <img :src="slide.mobile_thumbnail_webp"
                        class="banner-image absolute inset-0 object-cover overflow-hidden h-full" :alt="slide.title"
                        :title="slide.title" />
                    </picture>
                    <div
                      class="banner-overlay absolute z-[1] inset-0 bg-[linear-gradient(0deg,#0009_25.12%,#0000_102.62%)]">
                    </div>
                    <div
                      class="banner-content z-10 relative p-6 pb-10 flex flex-col gap-2 lg:gap-0 lg:flex-row lg:justify-between lg:items-end">
                      <div class="flex flex-col gap-2 lg:max-w-[80%]">
                        <span class="py-1.5 px-4 font-semibold bg-white text-neutral-4 rounded-full text-sm w-max"
                          x-text="slide.title">
                        </span>

                        <p class="text-white text-base lg:text-[2rem] lg:leading-10 font-semibold"
                          x-text="slide.short_description"></p>
                      </div>
                      <div>
                        <button type="button"
                          class="h-10 flex justify-center items-center bg-white text-blue-1 rounded-lg font-semibold px-8 text-xs border border-blue-1 lg:border-none w-full lg:w-max"
                          x-text="slide.action_text"></button>
                      </div>
                    </div>
                  </article>
                </a>
              </div>
            </template>
          </div>
          <div class="swiper-pagination lg:!left-6 lg:!text-left"></div>
        </div>
      </div>
      <button type="button" @click="swiper.slideNext()"
        class="size-12 2xl:static absolute right-8 z-[1] hidden lg:flex justify-center items-center text-neutral-4 bg-white transition-colors duration-200 hover:bg-neutral-2 rounded-full">
        <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 15" width="8px">
          <path d="M.175 1.238L1.399 0 9 7.523 1.397 15l-1.22-1.242L6.52 7.52.175 1.24z" fill="currentColor"></path>
        </svg>
      </button>
    </div>
  </section>
