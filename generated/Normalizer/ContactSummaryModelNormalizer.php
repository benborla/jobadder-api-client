<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class ContactSummaryModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\ContactSummaryModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\ContactSummaryModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\ContactSummaryModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'contactId')) {
            $object->setContactId($data->{'contactId'});
        }
        if (property_exists($data, 'firstName')) {
            $object->setFirstName($data->{'firstName'});
        }
        if (property_exists($data, 'lastName')) {
            $object->setLastName($data->{'lastName'});
        }
        if (property_exists($data, 'position')) {
            $object->setPosition($data->{'position'});
        }
        if (property_exists($data, 'email')) {
            $object->setEmail($data->{'email'});
        }
        if (property_exists($data, 'phone')) {
            $object->setPhone($data->{'phone'});
        }
        if (property_exists($data, 'mobile')) {
            $object->setMobile($data->{'mobile'});
        }
        if (property_exists($data, 'status')) {
            $object->setStatus($this->serializer->deserialize($data->{'status'}, 'BenBorla\\JobAdder\\V2\\Model\\StatusModel', 'raw', $context));
        }
        if (property_exists($data, 'createdBy')) {
            $object->setCreatedBy($this->serializer->deserialize($data->{'createdBy'}, 'BenBorla\\JobAdder\\V2\\Model\\UserSummaryModel', 'raw', $context));
        }
        if (property_exists($data, 'createdAt')) {
            $object->setCreatedAt(\DateTime::createFromFormat("Y-m-d\TH:i:sP", $data->{'createdAt'}));
        }
        if (property_exists($data, 'updatedBy')) {
            $object->setUpdatedBy($this->serializer->deserialize($data->{'updatedBy'}, 'BenBorla\\JobAdder\\V2\\Model\\UserSummaryModel', 'raw', $context));
        }
        if (property_exists($data, 'updatedAt')) {
            $object->setUpdatedAt(\DateTime::createFromFormat("Y-m-d\TH:i:sP", $data->{'updatedAt'}));
        }
        if (property_exists($data, 'company')) {
            $object->setCompany($this->serializer->deserialize($data->{'company'}, 'BenBorla\\JobAdder\\V2\\Model\\CompanyNameModel', 'raw', $context));
        }
        if (property_exists($data, 'officeAddress')) {
            $object->setOfficeAddress($this->serializer->deserialize($data->{'officeAddress'}, 'BenBorla\\JobAdder\\V2\\Model\\CompanyAddressModel', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getContactId()) {
            $data->{'contactId'} = $object->getContactId();
        }
        if (null !== $object->getFirstName()) {
            $data->{'firstName'} = $object->getFirstName();
        }
        if (null !== $object->getLastName()) {
            $data->{'lastName'} = $object->getLastName();
        }
        if (null !== $object->getPosition()) {
            $data->{'position'} = $object->getPosition();
        }
        if (null !== $object->getEmail()) {
            $data->{'email'} = $object->getEmail();
        }
        if (null !== $object->getPhone()) {
            $data->{'phone'} = $object->getPhone();
        }
        if (null !== $object->getMobile()) {
            $data->{'mobile'} = $object->getMobile();
        }
        if (null !== $object->getStatus()) {
            $data->{'status'} = $this->serializer->serialize($object->getStatus(), 'raw', $context);
        }
        if (null !== $object->getCreatedBy()) {
            $data->{'createdBy'} = $this->serializer->serialize($object->getCreatedBy(), 'raw', $context);
        }
        if (null !== $object->getCreatedAt()) {
            $data->{'createdAt'} = $object->getCreatedAt()->format("Y-m-d\TH:i:sP");
        }
        if (null !== $object->getUpdatedBy()) {
            $data->{'updatedBy'} = $this->serializer->serialize($object->getUpdatedBy(), 'raw', $context);
        }
        if (null !== $object->getUpdatedAt()) {
            $data->{'updatedAt'} = $object->getUpdatedAt()->format("Y-m-d\TH:i:sP");
        }
        if (null !== $object->getCompany()) {
            $data->{'company'} = $this->serializer->serialize($object->getCompany(), 'raw', $context);
        }
        if (null !== $object->getOfficeAddress()) {
            $data->{'officeAddress'} = $this->serializer->serialize($object->getOfficeAddress(), 'raw', $context);
        }

        return $data;
    }
}
