<nav class="fixed bottom-0 w-full bg-white border-t border-gray-200">
      <div class="max-w-lg mx-auto flex justify-around py-2">
            <a href="{{ route('posts.index') }}" class="flex flex-col items-center text-xs py-1 {{ request()->routeIs('posts.index') ? 'text-primary' : 'text-gray-500' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                  </svg>
                  <span>ホーム</span>
            </a>
            <a href="{{ route('albums.index') }}" class="flex flex-col items-center text-xs py-1 {{ request()->routeIs('albums.index') ? 'text-primary' : 'text-gray-500' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  <span>アルバム</span>
            </a>
            <a href="{{ route('posts.create') }}" class="flex flex-col items-center text-xs py-1 {{ request()->routeIs('posts.create') ? 'text-primary' : 'text-gray-500' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  <span>投稿</span>
            </a>
            <a href="{{ route('friends.index') }}" class="flex flex-col items-center text-xs py-1 {{ request()->routeIs('friends.index') ? 'text-primary' : 'text-gray-500' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <span>友達</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center text-xs py-1 {{ request()->routeIs('profile.edit') ? 'text-primary' : 'text-gray-500' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  <span>マイページ</span>
            </a>
      </div>
</nav>