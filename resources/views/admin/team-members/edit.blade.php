@extends('layouts.admin')

@section('title', 'Edit Team Member')
@section('page_title', 'Edit Team Member')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.team-members.index') }}" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Team</a>
    </div>

    <div class="admin-card max-w-2xl">
        <form method="POST" action="{{ route('admin.team-members.update', $teamMember->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $teamMember->name) }}" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" id="designation" name="designation" class="form-input" value="{{ old('designation', $teamMember->designation) }}" required>
                </div>
                <div>
                    <label for="role_type" class="form-label">Role Type</label>
                    <select id="role_type" name="role_type" class="form-input">
                        <option value="advisor" {{ $teamMember->role_type === 'advisor' ? 'selected' : '' }}>Advisor</option>
                        <option value="executive" {{ $teamMember->role_type === 'executive' ? 'selected' : '' }}>Executive Board</option>
                        <option value="staff" {{ $teamMember->role_type === 'staff' ? 'selected' : '' }}>Staff Member</option>
                        <option value="volunteer" {{ $teamMember->role_type === 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="country" class="form-label">University / Country Flag (Optional)</label>
                    <input type="text" id="country" name="country" class="form-input" value="{{ old('country', $teamMember->country) }}">
                </div>
                <div>
                    <label for="order" class="form-label">Sort Order</label>
                    <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $teamMember->order) }}" required>
                </div>
            </div>

            <h3 class="text-white font-heading font-semibold text-lg mb-6 border-b border-glass-border/30 pb-2">Contact & Academic Profiles</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="email" class="form-label">Email Address (Optional)</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $teamMember->email) }}">
                </div>
                <div>
                    <label for="phone" class="form-label">Phone Number (Optional)</label>
                    <input type="text" id="phone" name="phone" class="form-input" value="{{ old('phone', $teamMember->phone) }}">
                </div>
                <div>
                    <label for="research_gate_url" class="form-label">ResearchGate URL (Optional)</label>
                    <input type="url" id="research_gate_url" name="research_gate_url" class="form-input" value="{{ old('research_gate_url', $teamMember->research_gate_url) }}">
                </div>
                <div>
                    <label for="google_scholar_url" class="form-label">Google Scholar URL (Optional)</label>
                    <input type="url" id="google_scholar_url" name="google_scholar_url" class="form-input" value="{{ old('google_scholar_url', $teamMember->google_scholar_url) }}">
                </div>
            </div>

            <div class="mb-8">
                <label for="photo" class="form-label">Profile Photo (Upload new to replace)</label>
                @if($teamMember->photo)
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ $teamMember->photo }}" alt="{{ $teamMember->name }}" class="w-14 h-14 rounded-full object-cover border border-glass-border/30">
                        <span class="text-text-secondary text-xs">Current photo</span>
                    </div>
                @endif
                <input type="file" id="photo" name="photo" class="form-input" accept="image/*" onchange="previewImg(this,'preview_photo')">
                <p class="text-text-muted text-xs mt-1">Leave empty to keep current · Auto-resized to 400×400 &amp; saved as WebP</p>
                <img id="preview_photo" src="" alt="" class="mt-2 rounded-full hidden w-20 h-20 object-cover border border-glass-border/30">
            </div>

            <button type="submit" class="btn-primary py-3 px-6">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </form>
    </div>
@endsection
