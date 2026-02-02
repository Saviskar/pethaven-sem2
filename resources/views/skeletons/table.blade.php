<div class="bg-white dark:bg-card-dark overflow-hidden shadow-sm rounded-lg border border-border-light dark:border-border-dark">
    <div class="p-6">
        <!-- Header Skeleton -->
        <div class="flex justify-between items-center mb-6">
            <x-skeleton class="h-8 w-1/4" />
            <x-skeleton class="h-10 w-32" />
        </div>
        
        <!-- Table Skeleton -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        @for($i = 0; $i < 5; $i++)
                            <th class="px-6 py-3 text-left">
                                <x-skeleton class="h-4 w-24" />
                            </th>
                        @endfor
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @for($row = 0; $row < 5; $row++)
                        <tr>
                            @for($col = 0; $col < 5; $col++)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-skeleton class="h-5 w-full" />
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
