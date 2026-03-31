import os
import re
import urllib.request
from urllib.parse import urlparse

# Pattern to find all unsplash images
url_pattern = re.compile(r'(https://images\.unsplash\.com/[^\s\'"<]+)')

# Define the targets
blade_dirs = ['resources/views']
seeder_dirs = ['database/seeders']

def get_clean_filename(url):
    parsed = urlparse(url)
    path = parsed.path
    if path.startswith('/'):
        path = path[1:]
    clean_name = path.replace('/', '_').split('?')[0]
    if not clean_name.endswith('.jpg'):
        clean_name += '.jpg'
    return clean_name

def download_image(url, local_path):
    if not os.path.exists(local_path):
        try:
            print(f"Downloading {url} to {local_path}")
            req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
            with urllib.request.urlopen(req) as response:
                with open(local_path, 'wb') as img_f:
                    img_f.write(response.read())
        except Exception as e:
            print(f"Failed to download {url}: {e}")

def process_files(dirs, output_dir, replacement_prefix, store_in_uploads=False):
    if not os.path.exists(output_dir):
        os.makedirs(output_dir)

    for d in dirs:
        for root, dirs_list, files in os.walk(d):
            for file in files:
                if file.endswith('.php'):
                    filepath = os.path.join(root, file)
                    with open(filepath, 'r', encoding='utf-8') as f:
                        content = f.read()

                    all_urls = list(set(url_pattern.findall(content)))
                    if not all_urls:
                        continue

                    modified = False
                    for url in all_urls:
                        filename = get_clean_filename(url)
                        local_path = os.path.join(output_dir, filename)
                        
                        download_image(url, local_path)
                        
                        replacement = f"{replacement_prefix}{filename}"
                        content = content.replace(url, replacement)
                        modified = True

                    if modified:
                        with open(filepath, 'w', encoding='utf-8') as f:
                            f.write(content)
                        print(f"Updated paths in: {filepath}")

if __name__ == "__main__":
    print("Starting blade views parsing...")
    process_files(blade_dirs, 'public/images/local', '/images/local/')
    
    # Store explicitly in the uploads directory relative to the view setup
    print("Starting seeders parsing...")
    process_files(seeder_dirs, 'public/uploads', '')
    
    print("All downloads and replacements complete!")
