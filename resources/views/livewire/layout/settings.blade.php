<div>
    <!-- Navigation Links -->
    <div style="
        display: flex; 
        gap: 2rem;
        margin-bottom: 1rem; 
        flex-wrap: wrap;
    ">
        <x-nav-link
            @click.prevent="showSection('clearance-type-section')"
            :active="request()->routeIs('clearance-type')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('Clearance Type') }}
        </x-nav-link>
        <x-nav-link
            @click.prevent="showSection('announcement-category-section')"
            :active="request()->routeIs('announcement-category')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('Announcement Category') }}
        </x-nav-link>
        <x-nav-link
            @click.prevent="showSection('information-category-section')"
            :active="request()->routeIs('information-category')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('Information Category') }}
        </x-nav-link>
        <x-nav-link
            @click.prevent="showSection('complaint-category-section')"
            :active="request()->routeIs('complaint-category')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('Complaint Category') }}
        </x-nav-link>
        <x-nav-link
            @click.prevent="showSection('item-category-section')"
            :active="request()->routeIs('item-category')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('Item Category') }}
        </x-nav-link>
         <x-nav-link
            @click.prevent="showSection('pdf-content-section')"
            :active="request()->routeIs('pdf-content')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('PDF Content') }}
        </x-nav-link>
        <x-nav-link
            @click.prevent="showSection('user-statistics-section')"
            :active="request()->routeIs('user-statistics')"
            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.color='#000';"
            onmouseout="if (!this.classList.contains('active')) { this.style.backgroundColor='#f0f0f0'; this.style.color='#333'; }"
            onclick="setActive(this)"
            class="nav-link"
        >
            {{ __('User Statistics') }}
        </x-nav-link>
    </div>

    <!-- Livewire Components Sections -->
    <div class="sections-container mt-15" >
        <div class="p-6 text-gray-900 dark:text-gray-100" id="clearance-type-section">
            @livewire('clearance-type')
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100 hidden" id="announcement-category-section">
            @livewire('announcement-category')
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100 hidden" id="information-category-section">
            @livewire('information-category')
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100 hidden" id="complaint-category-section">
            @livewire('complaint-category')
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100 hidden" id="item-category-section">
            @livewire('item-category')
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100 hidden" id="pdf-content-section">
            @livewire('pdf-content')
        </div>
        <div class="p-6 text-gray-900 dark:text-gray-100 hidden" id="user-statistics-section">
            @livewire('user-statistics')
        </div>
    </div>
</div>

<script>
    function showSection(sectionId) {
        // Hide all sections
        const sections = document.querySelectorAll('.sections-container .p-6');
        sections.forEach(section => {
            section.classList.add('hidden');
        });

        // Show the targeted section
        const targetSection = document.getElementById(sectionId);
        if (targetSection) {
            targetSection.classList.remove('hidden');
            targetSection.scrollIntoView({ behavior: 'smooth' });
        }
    }

    function setActive(element) {
        // Remove active class from all nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            link.style.backgroundColor = '#f0f0f0'; // Reset background color
        });

        // Add active class to the clicked link
        element.classList.add('active');
        element.style.backgroundColor = '#d0d0d0'; // Set background color for the active link
    }

    // Set default section to visible
    document.addEventListener('DOMContentLoaded', () => {
        showSection('clearance-type-section');
        // Set the default active link
        const defaultLink = document.querySelector('.nav-link');
        if (defaultLink) {
            setActive(defaultLink);
        }
    });
</script>
