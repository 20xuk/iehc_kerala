# Sidebar Toggle Functionality

## Overview
The IEHCKerala application now has an improved sidebar that can be collapsed to show only icons, providing more screen space while maintaining navigation functionality.

## Features

### 1. Collapsible Sidebar
- **Toggle Button**: Click the hamburger menu icon (☰) in the top-left corner
- **Collapsed State**: Sidebar shrinks to 4rem width showing only icons
- **Expanded State**: Full sidebar with text labels and section headings

### 2. Icon-Only Mode
When collapsed:
- ✅ **Icons remain visible** and centered
- ❌ **Text labels are hidden**
- ❌ **Section headings are hidden**
- ❌ **Brand name is hidden**
- ✅ **Toggle icon rotates** to indicate state

### 3. Tooltip System
When hovering over icons in collapsed mode:
- **Tooltips appear** showing the menu item name
- **Dark background** with white text
- **Arrow pointer** pointing to the icon
- **Smooth animations** for show/hide

### 4. Responsive Behavior
- **Mobile (< 768px)**: Automatically collapsed
- **Desktop (≥ 768px)**: Remembers user's preference
- **State persistence**: Uses localStorage to remember collapsed/expanded state

### 5. Smooth Animations
- **0.3s transitions** for all sidebar movements
- **0.2s transitions** for tooltip animations
- **Smooth icon rotation** for toggle button

## How It Works

### CSS Classes
```css
.sidebar.collapsed {
    width: 4rem;
}

.sidebar.collapsed .sidebar-text,
.sidebar.collapsed .sidebar-heading {
    display: none;
}

.sidebar.collapsed .nav-item {
    justify-content: center;
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}
```

### JavaScript Functionality
```javascript
// Toggle sidebar
document.getElementById('sidebar-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
    
    // Store state in localStorage
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
});
```

### Tooltip System
```css
.sidebar.collapsed .nav-item::after {
    content: attr(data-tooltip);
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    background: #1f2937;
    color: white;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    /* ... more styles */
}
```

## Usage

### For Users
1. **Click the hamburger menu** (☰) to toggle sidebar
2. **Hover over icons** when collapsed to see tooltips
3. **State is remembered** between page loads
4. **Mobile automatically collapses** for better UX

### For Developers
1. **Add `data-tooltip` attribute** to navigation items for tooltips
2. **Use `sidebar-text` class** for text that should hide when collapsed
3. **Use `sidebar-heading` class** for section headings that should hide when collapsed

## Benefits

- **More Screen Space**: Collapsed sidebar provides more room for content
- **Better Mobile Experience**: Automatically optimized for small screens
- **User Preference**: Remembers user's sidebar state
- **Accessibility**: Tooltips provide context when text is hidden
- **Smooth UX**: Professional animations and transitions

## Browser Support

- **localStorage**: For state persistence
- **CSS Transitions**: For smooth animations
- **CSS Pseudo-elements**: For tooltip system
- **Modern browsers**: Chrome, Firefox, Safari, Edge
