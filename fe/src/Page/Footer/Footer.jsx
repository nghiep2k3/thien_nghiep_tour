import React from 'react';
import { Layout, Row, Col, Typography, Space } from 'antd';
import { FacebookOutlined, TwitterOutlined, InstagramOutlined, MailOutlined, PhoneOutlined } from '@ant-design/icons';

const { Footer } = Layout;
const { Title, Text } = Typography;

const TourFooter = () => {
    return (
        <Footer style={{ backgroundColor: '#001529', color: '#fff'}}>
            <Row gutter={[16, 16]} justify="center">
                <Col xs={24} sm={12} md={8} lg={6}>
                    <Title level={4} style={{ color: '#fff' }}>Về Chúng Tôi</Title>
                    <Text style={{ color: '#aaa' }}>Chúng tôi cung cấp các dịch vụ đặt tour du lịch uy tín và chuyên nghiệp, mang lại những trải nghiệm tuyệt vời cho khách hàng.</Text>
                </Col>
                <Col xs={24} sm={12} md={8} lg={6}>
                    <Title level={4} style={{ color: '#fff' }}>Liên Hệ</Title>
                    <Space direction="vertical" style={{ color: '#aaa' }}>
                        <Text style={{ color: '#aaa' }}><MailOutlined /> contact@tourbooking.com</Text>
                        <Text style={{ color: '#aaa' }}><PhoneOutlined /> +84 123 456 789</Text>
                    </Space>
                </Col>
                <Col xs={24} sm={12} md={8} lg={6}>
                    <Title level={4} style={{ color: '#fff' }}>Theo Dõi Chúng Tôi</Title>
                    <Space style={{display: 'flex', justifyContent: 'space-between', width: 180}}>
                        <FacebookOutlined style={{ fontSize: '24px', color: '#fff' }} />
                        <TwitterOutlined style={{ fontSize: '24px', color: '#fff' }} />
                        <InstagramOutlined style={{ fontSize: '24px', color: '#fff' }} />
                    </Space>
                </Col>
            </Row>
            <Row justify="center" style={{ marginTop: '30px' }}>
                <Text style={{ color: '#aaa' }}>© 2024 TourBooking. All rights reserved.</Text>
            </Row>
        </Footer>
    );
};

export default TourFooter;
