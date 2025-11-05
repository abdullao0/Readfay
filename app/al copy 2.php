$address->update([
                'title'       => $validated['title'] ?? $address->title,
                'description' => $validated['description'] ?? $address->description,
                'phone'       => $validated['phone'] ?? $address->phone,
                'longitude'   => $validated['longitude'] ?? $address->longitude,
                'latitude'    => $validated['latitude'] ?? $address->latitude,
                'is_active'   => $validated['is_active'] ?? $address->is_active,
            ]);


            $address->update([
                'title'       => $validated['title'],
                'description' => $validated['description'],
                'phone'       => $validated['phone'] ?? $address->phone,
                'longitude'   => $validated['longitude'] ?? $address->longitude,
                'latitude'    => $validated['latitude'] ?? $address->latitude,
                'is_active'   => $validated['is_active'] ?? $address->is_active,
            ]);











            $path = $request->file('image')->store('profiles', 'public');
 


$address->update([
                ‘image’       =>   $path ,
                'description' => $validated['description'],
                'phone'       => $validated['phone'] ?? $address->phone,
                'longitude'   => $validated['longitude'] ?? $address->longitude,
                'latitude'    => $validated['latitude'] ?? $address->latitude,
                'is_active'   => $validated['is_active'] ?? $address->is_active,
            ]);