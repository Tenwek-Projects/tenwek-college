<x-layouts.admin header="COHS — Hospital board members">
    <p class="mb-4 max-w-3xl text-sm leading-relaxed text-thc-text/85">
        Published members appear on the
        <a href="{{ route('schools.pages.show', [$cohs, 'about-us']) }}" class="admin-link" target="_blank" rel="noopener">About us</a>
        page under “Hospital board members”. Section headings still live under
        <a href="{{ route('admin.cohs.about-us.edit') }}" class="admin-link">About us (landing)</a>.
        Upload a portrait per person here.
    </p>
    <div class="admin-toolbar">
        <div class="admin-toolbar-actions">
            <a href="{{ route('admin.cohs.board.create') }}" class="admin-btn-primary admin-btn-sm">Add board member</a>
        </div>
        <a href="{{ route('admin.cohs.dashboard') }}" class="admin-btn-ghost admin-btn-sm">← COHS CMS</a>
    </div>
    <div class="admin-table-wrap">
        <div class="admin-table-scroll">
            <table class="admin-table admin-table--zebra">
                <thead>
                    <tr>
                        <th class="w-16">Photo</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $m)
                        <tr>
                            <td>
                                @if (filled($m->image_path))
                                    @php($thumb = \App\Support\Cohs\CohsLandingRepository::publicMediaUrl($m->image_path) ?? asset($m->image_path))
                                    <img src="{{ $thumb }}" alt="" class="h-10 w-8 rounded object-cover ring-1 ring-thc-navy/10" width="32" height="40" loading="lazy" decoding="async">
                                @else
                                    <span class="text-thc-text/40">—</span>
                                @endif
                            </td>
                            <td class="font-medium text-thc-navy">
                                {{ $m->name }}
                                @if ($m->highlight)
                                    <x-admin.ui.badge variant="success" class="ml-1">Highlight</x-admin.ui.badge>
                                @endif
                            </td>
                            <td class="text-thc-text/80">{{ \Illuminate\Support\Str::limit($m->role_title, 48) }}</td>
                            <td>{{ $m->sort_order }}</td>
                            <td>
                                @if ($m->is_published)
                                    <x-admin.ui.badge variant="success">Live</x-admin.ui.badge>
                                @else
                                    <x-admin.ui.badge variant="muted">Draft</x-admin.ui.badge>
                                @endif
                            </td>
                            <td>
                                <div class="admin-table-actions">
                                    <a href="{{ route('admin.cohs.board.edit', $m) }}" class="admin-link">Edit</a>
                                    <form method="post" action="{{ route('admin.cohs.board.destroy', $m) }}" class="inline" onsubmit="return confirm('Delete this board member?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-700 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table-empty">No board members yet — site will use config defaults until you add people here.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $members->links() }}
</x-layouts.admin>
