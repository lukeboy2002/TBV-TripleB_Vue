<script lang="ts" setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import LinkNav from "@/Components/LinkNav.vue";
import LinkDropdown from "@/Components/LinkDropdown.vue";
import Dropdown from "@/Components/Dropdown.vue";

import { router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import LinkNavResponsive from "@/Components/LinkNavResponsive.vue";

const showingNavigationDropdown = ref(false);

const logout = () => {
  router.post(route("logout"));
};

const menu = [
  {
    name: "Home",
    url: route("home"),
    route: "home"
  },
  {
    name: "Gallery",
    url: route("galley"),
    route: "galley"
  },
  {
    name: "Specials",
    url: route("specials"),
    route: "specials"
  },
  {
    name: "About-Us",
    url: route("about-us"),
    route: "about-us"
  },
  {
    name: "Book",
    url: route("book"),
    route: "book"
  },
  {
    name: "Events",
    url: route("events"),
    route: "events"
  },
  {
    name: "Shop",
    url: route("shop"),
    route: "shop"
  },
  {
    name: "Blog",
    url: route("posts.index"),
    route: "posts.index"
  },
  {
    name: "Create a Post",
    url: route("posts.create"),
    route: "posts.create",
    when: () => usePage().props.permissions.create_posts
  },
  {
    name: "Contact",
    url: route("contact"),
    route: "contact"
  }
];
</script>

<template>
  <div class="sticky top-0 z-40">
    <nav class="bg-menu/90">
      <!-- Primary Navigation Menu -->
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14">
          <div class="flex items-center text-xl font-black text-orange-500 tracking-widest">
            <ApplicationLogo />
            TBV-TripleB
          </div>
          <div class="flex">
            <!-- Navigation Links -->
            <div class="hidden space-x-4 sm:-my-px sm:flex">
              <template v-for="item in menu" :key="item.name">
                <LinkNav
                  v-if="item.when ? item.when() : true"
                  :active="route().current(item.route)"
                  :href="item.url"
                >
                  {{ item.name }}
                </LinkNav>
              </template>
              <div class="border border-l border-orange-500/30"></div>
            </div>

            <div class="hidden sm:ms-6 sm:flex sm:items-center sm:space-x-4">
              <div v-if="$page.props.auth.user" class="relative ms-3">
                <!-- Settings Dropdown -->
                <div class="relative ms-3">
                  <Dropdown align="right" width="48">
                    <template #trigger>
                      <button
                        v-if="$page.props.jetstream.managesProfilePhotos"
                        class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-none"
                      >
                        <img :alt="$page.props.auth.user.username"
                             :src="$page.props.auth.user.profile_photo_url"
                             class="h-8 w-8 rounded-full object-cover"
                        />
                      </button>

                      <span v-else class="inline-flex rounded-md">
                        <button
                          class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50"
                          type="button"
                        >
                            {{ $page.props.auth.user.username }}

                            <svg class="-me-0.5 ms-2 h-4 w-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"
                            >
                                <path d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                />
                            </svg>
                        </button>
                    </span>
                    </template>

                    <template #content>
                      <!-- Account Management -->
                      <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Account
                      </div>

                      <LinkDropdown :href="route('profile.show')">
                        Profile
                      </LinkDropdown>

                      <div class="border-t border-gray-200" />

                      <!-- Authentication -->
                      <form @submit.prevent="logout">
                        <LinkDropdown as="button">
                          Log Out
                        </LinkDropdown>
                      </form>
                    </template>
                  </Dropdown>
                </div>
              </div>
              <div v-else class="space-x-2">
                <LinkNav :href="route('login')">
                  Log in
                </LinkNav>

                <LinkNav :href="route('register')">
                  Register
                </LinkNav>
              </div>
            </div>
          </div>
          <!-- Hamburger -->
          <div class="-me-2 flex items-center space-x-2 sm:hidden">
            <button
              class="inline-flex items-center justify-center rounded-md p-2 text-orange-500 transition duration-150 ease-in-out hover:bg-menu/50 hover:text-orange-500 focus:bg-menu/50 focus:text-orange-500 focus:outline-none dark:hover:bg-gray-600 dark:focus:bg-gray-800"
              @click=" showingNavigationDropdown = !showingNavigationDropdown "
            >
              <svg
                class="h-6 w-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  :class="{ hidden: showingNavigationDropdown,
                            'inline-flex': !showingNavigationDropdown,
                          }"
                  d="M4 6h16M4 12h16M4 18h16"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                />
                <path
                  :class="{ hidden: !showingNavigationDropdown,
                            'inline-flex': showingNavigationDropdown,
                          }"
                  d="M6 18L18 6M6 6l12 12"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Responsive Navigation Menu -->
      <div
        :class="{ block: showingNavigationDropdown,
                  hidden: !showingNavigationDropdown,
                }"
        class="sm:hidden"
      >
        <div class="space-y-1 pb-3 pt-2">
          <template v-for="item in menu" :key="item.name">
            <LinkNavResponsive
              v-if="item.when ? item.when() : true"
              :active="route().current(item.route)"
              :href="item.url"
            >
              {{ item.name }}
            </LinkNavResponsive>
          </template>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pb-1 pt-4">
          <div v-if="$page.props.auth.user">
            <div class="flex items-center px-4">
              <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="me-3 shrink-0"
              >
                <img
                  :alt="$page.props.auth.user.username"
                  :src="$page.props.auth.user.profile_photo_url"
                  class="h-10 w-10 rounded-full object-cover"
                />
              </div>

              <div>
                <div class="text-base font-medium text-gray-800">
                  {{ $page.props.auth.user.username }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <LinkNavResponsive
                :active="route().current('profile.show')"
                :href="route('profile.show')"
              >
                Profile
              </LinkNavResponsive>

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <LinkNavResponsive as="button">
                  Log Out
                </LinkNavResponsive>
              </form>
            </div>
          </div>
          <div v-else class="mt-3 space-y-1">
            <LinkNavResponsive :href="route('login')">
              Log in
            </LinkNavResponsive>

            <LinkNavResponsive :href="route('register')">
              Register
            </LinkNavResponsive>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>
