public function update(UpdateAddressRequest $request, Address $address)
    {
        try {
            $this->authorize('update', $address);
            $validated = $request->validated();
            if (isset($validated['dial_code']) || isset($validated['phone'])) {
                $dialCode = $validated['dial_code'] ?? '';
                $phone    = $validated['phone'] ?? '';
                $validated['phone'] = $dialCode . $phone;
            }
            $address->update([
                'title'       => $validated['title'] ?? $address->title,
                'description' => $validated['description'] ?? $address->description,
                'phone'       => $validated['phone'] ?? $address->phone,
                'longitude'   => $validated['longitude'] ?? $address->longitude,
                'latitude'    => $validated['latitude'] ?? $address->latitude,
                'is_active'   => $validated['is_active'] ?? $address->is_active,
            ]);