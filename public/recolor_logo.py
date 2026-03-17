from PIL import Image

image_path = r'd:\Antigravity 1\mystic-mall-v2\public\images\logo-icon.png'
img = Image.open(image_path).convert("RGBA")

data = img.getdata()
new_data = []

# Gold color: #FFD700 -> (255, 215, 0)
for item in data:
    # If the pixel is not fully transparent, color it gold but keep its original alpha
    if item[3] > 0:
        # To preserve semi-transparent edges (anti-aliasing)
        new_data.append((255, 215, 0, item[3]))
    else:
        new_data.append(item)

img.putdata(new_data)

output_path = r'd:\Antigravity 1\mystic-mall-v2\public\images\logo-icon-gold.png'
img.save(output_path, "PNG")
print(f"Successfully processed and saved to {output_path}")
