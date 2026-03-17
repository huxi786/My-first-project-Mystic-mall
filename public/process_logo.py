from PIL import Image

image_path = r'd:\Antigravity 1\mystic-mall-v2\public\images\logo.png'
print(f"Loading {image_path}...")
img = Image.open(image_path).convert("RGBA")

data = img.getdata()
new_data = []

# Make white pixels transparent
for item in data:
    # Check if pixel is white-ish
    if item[0] > 240 and item[1] > 240 and item[2] > 240:
        new_data.append((255, 255, 255, 0))
    else:
        new_data.append(item)

img.putdata(new_data)

# Find bounding box of non-transparent pixels
bbox = img.getbbox()
if bbox:
    left, upper, right, lower = bbox
    # Since the icon is roughly the left half of the content, let's crop there.
    # We will search for a gap (fully transparent column)
    width = right - left
    height = lower - upper
    cropped = img.crop((left, upper, right, lower))
    
    # Simple heuristic: the icon is about 30-40% of the total width of the content.
    icon_width = int(width * 0.45)
    
    # Refined search for a blank column
    gap_col = -1
    for x in range(icon_width // 2, width):
        transparent = True
        for y in range(height):
            pixel = cropped.getpixel((x, y))
            if pixel[3] > 0:
                transparent = False
                break
        if transparent:
            gap_col = x
            break
            
    if gap_col != -1:
        end_x = gap_col
    else:
        end_x = icon_width
        
    final_icon = cropped.crop((0, 0, end_x, height))
    
    output_path = r'd:\Antigravity 1\mystic-mall-v2\public\images\logo-icon.png'
    final_icon.save(output_path, "PNG")
    print(f"Successfully processed and saved to {output_path}")
else:
    print("Could not find content.")
